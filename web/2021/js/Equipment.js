import Participants from './Participants.js';
import {loadLS, saveLS} from './ls.js';

export default class Equipment {
    constructor() {
        this.participants = new Participants();
        this.equipmentList = this.convertEquipmentList();
        this.displayEquipment();
    }

    displayEquipment() {
        console.log(this.participants.list);
        if (this.participants.list.length > 0) {
            this.displayItemCheckList();
        } else {
            this.displayItemList();
        }
    }

    convertEquipmentList() {
        let equipmentList = {};
        console.log(equipmentlist);
        equipmentlist.forEach(item => {
            if(!equipmentList.hasOwnProperty(item.category)){
                equipmentList[item.category] = [{'equipmentid': item.equipmentid, 'equipmentname': item.equipmentname, 'quantity': item.quantity, 'avgprice': item.avgprice, 'bring': item.bring, 'ywcamp': item.ywcamp, 'ymcamp': item.ymcamp, 'trek': item.trek}];
            } else {
                equipmentList[item.category].push({'equipmentid': item.equipmentid, 'equipmentname': item.equipmentname, 'quantity': item.quantity, 'avgprice': item.avgprice, 'bring': item.bring, 'ywcamp': item.ywcamp, 'ymcamp': item.ymcamp, 'trek': item.trek});
            }
        });
        return equipmentList;
    }

    displayItemList() {
        console.log(this.equipmentList);
        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.classList.add('equipment-lists-standard');

        Object.keys(this.equipmentList).forEach(key => {
            let h2 = document.createElement('h2');
            let ul = document.createElement('ul');

            h2.innerHTML = key;
            ul.classList.add(key.replace(/ /g,"-"));            

            this.equipmentList[key].forEach(item => {
                let li = document.createElement('li');

                li.innerHTML = item.equipmentname;

                ul.appendChild(li);
            });

            equipDiv.appendChild(h2);
            equipDiv.appendChild(ul);
        });

    }

    displayItemCheckList() {
        console.log(this.equipmentList);
        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.classList.add('equipment-lists-interactive');

        Object.keys(this.equipmentList).forEach(key => {
            let h2 = document.createElement('h2');
            let ul = document.createElement('ul');

            h2.innerHTML = "<input type='checkbox' id='" + key.replace(/ /g,"-").toLowerCase() + "' name='" + key.replace(/ /g,"-").toLowerCase() + "'><label for='" + key.replace(/ /g,"-").toLowerCase() + "'>" + key + "</label>";
            ul.classList.add(key.replace(/ /g,"-").toLowerCase());            

            this.equipmentList[key].forEach(item => {
                let li = document.createElement('li');
                let labelTxt;
                if (item.quantity != '1'){
                    labelTxt = item.quantity + " " + item.equipmentname;
                } else {
                    labelTxt = item.equipmentname;
                }
                
                li.innerHTML = "<input type='checkbox' id='item-" + item.equipmentid + "' name='item-" + item.equipmentid + "'><label for='item-" + item.equipmentid + "'>" + labelTxt + "</label>";

                ul.appendChild(li);
            });

            equipDiv.appendChild(h2);
            equipDiv.appendChild(ul);
        });
    }

}

class Item {
    constructor(id, name, quantity, category, haveGot, avgPrice, actPrice) {
        this.id = id;
        this.itemName = name;
        this.quantity = quantity;
        this.category = category;
        this.haveGot = haveGot;
        this.avgPrice = avgPrice;
        this.actPrice = actPrice;
    }
}

