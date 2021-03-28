import Participants from './Participants.js';

export default class Equipment {
    constructor() {
        this.participants = new Participants(this.buildEquipment.bind(this));
        //this.list = {};
    }

    buildEquipment(list) {
        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.innerHTML="";

        console.log(list);
        if (list.length > 0) {
            list.forEach(participant => {
                // console.log(participant);
                this.getEquipment(this, participant.id)
                //this.displayItemCheckList(participant);
            });            
        } else {
            this.getEquipment(this, null)
            //this.displayItemList();
        }
    }

    getEquipment(master, id) {
        let url = "/2021/query/?action=getEquipment&reg_id=" + id;
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            //do stuff with data...
            if (this.readyState == 4 && this.status == 200) {
                let myDBRes = JSON.parse(this.responseText);
                // console.log(myDBRes);
                master.convertEquipmentList(myDBRes, id);
            } else if (this.readyState == 4 && this.status == 404) {
                /*
                let err404 = document.createElement("p");
                err404.className = "err404";
                err404.textContent = "404: JSON file not found. Try again; perhaps using a valid file name this time."
                */
            } else {
                // console.log("failed");
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }

    
    convertEquipmentList(dbEquipment, id) {
        let equipmentList = {};
        dbEquipment.forEach(item => {
            if(!equipmentList.hasOwnProperty(item.category)){
                equipmentList[item.category] = [{'owned': item.owned,
                                                'id': item.id,
                                                'quantity': item.quantity,
                                                'name': item.name,                                                  
                                                'avg_price': item.avg_price, 
                                                'pur_price': item.pur_price,
                                                'category': item.category.replace(/ /g,"-").toLowerCase()}];
            } else {
                equipmentList[item.category].push({ 'owned': item.owned,
                                                    'id': item.id,
                                                    'quantity': item.quantity,
                                                    'name': item.name,                                                  
                                                    'avg_price': item.avg_price, 
                                                    'pur_price': item.pur_price,
                                                    'category': item.category.replace(/ /g,"-").toLowerCase()});
            }
        });
        //this.list = equipmentList;
        // console.log(this.equipmentList);
        this.displayEquipment(id, equipmentList);
    }

    displayEquipment(id, equipmentList) {
        if (id) {
            this.displayItemCheckList(id, equipmentList);            
        } else {
            this.displayItemList(equipmentList);
        }
    }
    
    displayItemList(equipmentList) {
        // console.log(equipmentList);
        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.classList.add('equipment-lists-standard');

        let pDiv = document.createElement('div');

        let xh2;
        let xul;

        Object.keys(equipmentList).forEach(key => {         
            let h2 = document.createElement('h2');
            let ul = document.createElement('ul');

            h2.innerHTML = key;
            ul.classList.add(key.replace(/ /g,"-"));            

            equipmentList[key].forEach(item => {
                let li = document.createElement('li');

                li.innerHTML = item.name;

                ul.appendChild(li);
            });

            
            pDiv.appendChild(h2);
            pDiv.appendChild(ul);

            if (key != "DO NOT BRING") { 
                pDiv.appendChild(h2);
                pDiv.appendChild(ul);
            } else {
                xh2 = h2;
                xul = ul;
            }
        });

        if(xh2 && xul){
            pDiv.appendChild(xh2);
            pDiv.appendChild(xul);
        }

        equipDiv.appendChild(pDiv);
    }

    displayItemCheckList(participant, equipmentList) {

        let master = this;

        // console.log(equipmentList);

        let pid = "p-" + participant;

        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.classList.add('equipment-lists-interactive');

        let pDiv = document.createElement('div');
        pDiv.classList.add(pid);       

        let dnb;

        Object.keys(equipmentList).forEach(key => {

            let cid = key.replace(/ /g,"-").toLowerCase();

            let pCatDiv = document.createElement('div');
            pCatDiv.classList.add(pid + "-" + cid);
            
            let h2 = document.createElement('h2');
            let ul = document.createElement('ul');

            let catInput = document.createElement('input');
            let catLabel = document.createElement('label');

            catInput.id = pid+ "-" + cid;
            catInput.name = cid;
            catInput.dataset.pid = participant;
            catInput.dataset.cid = cid;
            catInput.type = "checkbox";
            catInput.checked = true;
            catInput.addEventListener('change', function () {
                master.updateCat(this.dataset.pid, this.dataset.cid, this.checked);
            })


            catLabel.htmlFor = pid + "-" + cid;
            catLabel.textContent = key;

            // TODO FIX THIS TO USE A CREATED INPUT AND LABEL ELEMENT!!! 
            h2.appendChild(catInput);
            h2.appendChild(catLabel);
            ul.classList.add(cid);
            
            equipmentList[key].forEach(item => {

                let iid = "-i-" + item.id;

                let li = document.createElement('li');
                let chkBox = document.createElement('input');
                let label = document.createElement('label');

                let identifier = pid + iid;

                chkBox.id = identifier;
                chkBox.name = identifier;
                chkBox.type = "checkbox";
                chkBox.dataset.pid = participant;
                chkBox.dataset.iid = item.id;
                chkBox.dataset.cat = item.category;
                chkBox.checked = item.owned;
                if(item.owned){ chkBox.classList.add("strike"); } else { chkBox.classList.remove("strike"); }

                if (!item.owned) {catInput.checked = item.owned};

                chkBox.addEventListener('change', function () {
                    master.updateItem(this.dataset.pid, this.dataset.iid, this.checked, this.dataset.cat);
                })

                label.htmlFor = identifier;
                if (item.quantity != '1'){
                    label.textContent = item.quantity + " " + item.name;
                } else {
                    label.textContent = item.name;
                }

                li.append(chkBox);
                li.append(label);
                ul.appendChild(li);
            });

            pCatDiv.appendChild(h2);
            pCatDiv.appendChild(ul);

            pDiv.appendChild(pCatDiv);

            equipDiv.appendChild(pDiv);

            // console.log(key);
            if (key == "DO NOT BRING") { 
                dnb = pCatDiv;
            }
        });

        dnb.remove()
        pDiv.appendChild(dnb);

    }
 
    updateItem(reg_id, item_id, owned, category, pur_price = 0.00) {

        // console.log(reg_id);
        // console.log(item_id);
        // console.log(owned);
        // console.log(category);
        // console.log(pur_price);

        //console.log("p-" + reg_id + "-" + category);

        // Verify the category for completion and set the checkbox state based on the outcome.
        let categoryChkBx = document.getElementById("p-" + reg_id + "-" + category);
        //console.log(categoryChkBx);

        let categoryChkBxs = document.querySelectorAll("[data-pid='" + reg_id + "'][data-cat='" + category + "']");
        //console.log(categoryChkBxs);
        
        let chkCategory = true;
        categoryChkBxs.forEach(chkbox => {
            if(!chkbox.checked) {chkCategory = false;}
        })        
        categoryChkBx.checked = chkCategory;

        // Trigger the AJAX post request to update the checkbox value in the db.
        this.postItem(reg_id, item_id, owned, pur_price = 0.00);
    }

    updateCat(reg_id, category, complete) {
        let categoryChkBxs = document.querySelectorAll("[data-pid='" + reg_id + "'][data-cat='" + category + "']");
        //console.log(categoryChkBxs);

        categoryChkBxs.forEach(chkbox => {
           chkbox.checked = complete;
           // add the update portion to the checkboxes...
           //console.log(chkbox);
           //console.log(chkbox.dataset.pid);
           //console.log(chkbox.dataset.iid);
           //console.log(complete);
           //console.log(category);
           this.postItem(chkbox.dataset.pid, chkbox.dataset.iid, complete);
        })

    }

    postItem(reg_id, item_id, owned, pur_price = 0.00) {

        // This gets trigger whenever a single checkbox is changed. 
        // It also gets triggered whenever the category checkbox is changed.

        console.log("p-" + reg_id + "-i-" + item_id);
        let strike = document.getElementById("p-" + reg_id + "-i-" + item_id);
        if(owned){ strike.classList.add("strike"); } else { strike.classList.remove("strike"); }

        let url = "/2021/query/";

        let data = new FormData();
        data.append('action', 'postItem');
        data.append('reg_id', reg_id);
        data.append('item_id', item_id);
        data.append('owned', owned);
        data.append('pur_price', pur_price);

        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            //do stuff with data...
            if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText)
                let myDBRes = JSON.parse(this.responseText);
                if(myDBRes) {
                    // SUCCESSFUL...
                }
            } else if (this.readyState == 4 && this.status == 404) {
                /*
                let err404 = document.createElement("p");
                err404.className = "err404";
                err404.textContent = "404: JSON file not found. Try again; perhaps using a valid file name this time."
                */
            } else {
                // console.log("failed");
            }
        };
        xmlhttp.open("POST", url, true);
        xmlhttp.send(data);
    }
}
