import Participants from './Participants.js';
import {loadLS, saveLS} from './ls.js';

export default class Equipment {
    constructor() {
        this.participants = new Participants();
        this.equipmentList = convertEquipmentList();
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
        equipmentlist.foreach(item => {
            if(!equipmentList.hasOwnProperty(item.category)){
                equipmentList[item.category] = [{'equipmentid': item.equipmentid, 'equipmentname': item.equipmentname, 'quantity': item.quantity, 'avgprice': item.avgprice, 'bring': item.bring, 'ywcamp': item.ywcamp, 'ymcamp': item.ymcamp, 'trek': item.trek}];
            } else {
                equipmentList[item.category].push({'equipmentid': item.equipmentid, 'equipmentname': item.equipmentname, 'quantity': item.quantity, 'avgprice': item.avgprice, 'bring': item.bring, 'ywcamp': item.ywcamp, 'ymcamp': item.ymcamp, 'trek': item.trek});
            }
        });
    }

    displayItemList() {
        console.log(this.equipmentList);
    }

    displayItemCheckList() {
        console.log(this.equipmentList);
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

