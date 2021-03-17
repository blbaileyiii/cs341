import Participants from './Participants.js';
import {loadLS, saveLS} from './ls.js';

export default class Equipment {
    constructor() {
        this.participants = new Participants();
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

    getItemList() {
        // TODO STUFF
    }

    displayItemList() {
        document.querySelector('.equipment-list').classList.remove("hidden");
    }

    displayItemCheckList() {
        document.querySelector('.equipment-interactive').classList.remove("hidden");
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
