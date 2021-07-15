import Participants from './Participants.js';

export default class Equipment {
    constructor() {
        this.participants = new Participants(this.buildEquipment.bind(this));
        //this.list = {};
    }

    buildEquipment(list) {
        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.innerHTML="";

        let master = this;

        // console.log(list);
        if (list.length > 0) {
            let div = document.createElement('div');
            div.classList.add('form');

            let divFields = document.createElement('div');
            divFields.classList.add('fields');

            let label = document.createElement('label');
            label.textContent = "Choose a participant:"
            label.htmlFor = "participantList";
            label.classList.add('owner');

            let select = document.createElement('select');
            select.id = "participantList";
            select.addEventListener('change', function () {
                master.changeListDisplayed(this.value); });

            list.forEach(participant => {
                // console.log(participant);
                
                let option = document.createElement('option');
                option.value = "p-" + participant.id;
                option.textContent = participant.p_name + " - " + participant.event_name;

                select.appendChild(option);

                this.getEquipment(this, participant)
                //this.displayItemCheckList(participant);
            });

            divFields.append(label);
            divFields.append(select);
            div.append(divFields);
            equipDiv.append(div);

        } else {
            this.getEquipment(this, null)
            //this.displayItemList();
        }
    }

    getEquipment(master, participant) {
        let id;
        if(participant){
            id = participant.id;
        }
        
        let url = "/2021/query/?action=getEquipment&reg_id=" + id;
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            //do stuff with data...
            if (this.readyState == 4 && this.status == 200) {
                let myDBRes = JSON.parse(this.responseText);
                // console.log(myDBRes);
                master.convertEquipmentList(myDBRes, participant);
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

    
    convertEquipmentList(dbEquipment, participant) {
        let equipmentList = {};
        // console.log(dbEquipment);
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
        // this.list = equipmentList;
        // console.log(equipmentList);

        let equipmentList2 = {ywcamp: {}, ymcamp: {}, trek: {}};
        // console.log(dbEquipment);
        dbEquipment.forEach(item => {

            if(item.ymcamp){
                if(!equipmentList2.ymcamp.hasOwnProperty(item.category)){
                    equipmentList2.ymcamp[item.category] = [{'owned': item.owned,
                                                    'id': item.id,
                                                    'quantity': item.quantity,
                                                    'name': item.name,                                                  
                                                    'avg_price': item.avg_price, 
                                                    'pur_price': item.pur_price,
                                                    'category': item.category.replace(/ /g,"-").toLowerCase()}];
                } else {
                    equipmentList2.ymcamp[item.category].push({ 'owned': item.owned,
                                                        'id': item.id,
                                                        'quantity': item.quantity,
                                                        'name': item.name,                                                  
                                                        'avg_price': item.avg_price, 
                                                        'pur_price': item.pur_price,
                                                        'category': item.category.replace(/ /g,"-").toLowerCase()});
                }
            }

            if(item.ywcamp){
                if(!equipmentList2.ywcamp.hasOwnProperty(item.category)){
                    equipmentList2.ywcamp[item.category] = [{'owned': item.owned,
                                                    'id': item.id,
                                                    'quantity': item.quantity,
                                                    'name': item.name,                                                  
                                                    'avg_price': item.avg_price, 
                                                    'pur_price': item.pur_price,
                                                    'category': item.category.replace(/ /g,"-").toLowerCase()}];
                } else {
                    equipmentList2.ywcamp[item.category].push({ 'owned': item.owned,
                                                        'id': item.id,
                                                        'quantity': item.quantity,
                                                        'name': item.name,                                                  
                                                        'avg_price': item.avg_price, 
                                                        'pur_price': item.pur_price,
                                                        'category': item.category.replace(/ /g,"-").toLowerCase()});
                }
            }

            if(item.trek){
                if(!equipmentList2.trek.hasOwnProperty(item.category)){
                    equipmentList2.trek[item.category] = [{'owned': item.owned,
                                                    'id': item.id,
                                                    'quantity': item.quantity,
                                                    'name': item.name,                                                  
                                                    'avg_price': item.avg_price, 
                                                    'pur_price': item.pur_price,
                                                    'category': item.category.replace(/ /g,"-").toLowerCase()}];
                } else {
                    equipmentList2.trek[item.category].push({ 'owned': item.owned,
                                                        'id': item.id,
                                                        'quantity': item.quantity,
                                                        'name': item.name,                                                  
                                                        'avg_price': item.avg_price, 
                                                        'pur_price': item.pur_price,
                                                        'category': item.category.replace(/ /g,"-").toLowerCase()});
                }
            }
        });
        console.log(equipmentList2);

        this.displayEquipment(participant, equipmentList2);
    }

    displayEquipment(participant, equipmentList2) {
        let id;
        if(participant){
            id = participant.id;
        }
        if (id) {
            this.displayItemCheckList(participant, equipmentList2);            
        } else {
            this.displayItemList(equipmentList2);
        }
    }
    
    displayItemList(equipmentList) {
        // console.log(equipmentList);
        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.classList.add('equipment-lists-standard');

        let pDiv = document.createElement('div');

        

        Object.keys(equipmentList).forEach(camp => {    
            let h2 = document.createElement('h2');

            let xh3;
            let xul;

            h2.innerHTML = camp.toUpperCase();
            pDiv.appendChild(h2);
            
            Object.keys(equipmentList[camp]).forEach(cat => {
                let h3 = document.createElement('h3');
                let ul = document.createElement('ul');

                h3.innerHTML = cat;
                ul.classList.add(cat.replace(/ /g,"-"));
                
                equipmentList[camp][cat].forEach(item => {
                    let li = document.createElement('li');

                    li.innerHTML = item.name;

                    ul.appendChild(li);
                });

                pDiv.appendChild(h3);
                pDiv.appendChild(ul);

                if (cat != "DO NOT BRING") { 
                    pDiv.appendChild(h3);
                    pDiv.appendChild(ul);
                } else {
                    xh3 = h3;
                    xul = ul;
                }

            })
            
            if(xh3 && xul){
                pDiv.appendChild(xh3);
                pDiv.appendChild(xul);
            }           

        });

        equipDiv.appendChild(pDiv);

    }

    displayItemCheckList(participant, equipmentList) {
        let id;
        let camp;
        if(participant){
            id = participant.id;
            camp = participant.event_name.toLowerCase().split(' ')[0];
            console.log(camp);
        }
        let master = this;

        let hiddenswitch = document.getElementById('participantList').value;

        // console.log(equipmentList);

        let pid = "p-" + id;

        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.classList.add('equipment-lists-interactive');

        let pDiv = document.createElement('div');
        pDiv.dataset.pid = pid;
        pDiv.classList.add("equipment-list");
        if (pid != hiddenswitch){ pDiv.classList.add("hidden"); }

        let dnb;

        Object.keys(equipmentList[camp]).forEach(key => {

            let cid = key.replace(/ /g,"-").toLowerCase();

            let pCatDiv = document.createElement('div');
            pCatDiv.classList.add(pid + "-" + cid);
            
            let h2 = document.createElement('h2');
            let ul = document.createElement('ul');

            let catInput = document.createElement('input');
            let catLabel = document.createElement('label');

            catInput.id = pid+ "-" + cid;
            catInput.name = cid;
            catInput.dataset.pid = id;
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
            
            equipmentList[camp][key].forEach(item => {

                let iid = "-i-" + item.id;

                let li = document.createElement('li');
                let chkBox = document.createElement('input');
                let label = document.createElement('label');

                let identifier = pid + iid;

                chkBox.id = identifier;
                chkBox.name = identifier;
                chkBox.type = "checkbox";
                chkBox.dataset.pid = id;
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

        if(dnb){
            dnb.remove()
        }
        pDiv.appendChild(dnb);

    }
 
    updateItem(reg_id, item_id, owned, category, pur_price = 0.00) {

        // console.log(reg_id);
        // console.log(item_id);
        // console.log(owned);
        // console.log(category);
        // console.log(pur_price);

        // console.log("p-" + reg_id + "-" + category);

        // Verify the category for completion and set the checkbox state based on the outcome.
        let categoryChkBx = document.getElementById("p-" + reg_id + "-" + category);
        // console.log(categoryChkBx);

        let categoryChkBxs = document.querySelectorAll("[data-pid='" + reg_id + "'][data-cat='" + category + "']");
        // console.log(categoryChkBxs);
        
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
        // console.log(categoryChkBxs);

        categoryChkBxs.forEach(chkbox => {
           chkbox.checked = complete;
           // add the update portion to the checkboxes...
           // console.log(chkbox);
           // console.log(chkbox.dataset.pid);
           // console.log(chkbox.dataset.iid);
           // console.log(complete);
           // console.log(category);
           this.postItem(chkbox.dataset.pid, chkbox.dataset.iid, complete);
        })

    }

    postItem(reg_id, item_id, owned, pur_price = 0.00) {

        // This gets trigger whenever a single checkbox is changed. 
        // It also gets triggered whenever the category checkbox is changed.

        // console.log("p-" + reg_id + "-i-" + item_id);
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

    changeListDisplayed(pid) {
        let equipmentLists = document.querySelectorAll('.equipment-list');
        //console.log(equipmentLists);
        equipmentLists.forEach(list => {
            if (pid == list.dataset.pid) {
                list.classList.remove('hidden');
            } else {
                list.classList.add('hidden');
            }            
        })
    }
}
