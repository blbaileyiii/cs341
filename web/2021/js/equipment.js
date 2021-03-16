class Equipment {
    constructor() {
    }

    getItemList() {

    }
}

class Participant {
    constructor(name, equipment) {
        this.participantName = name;
        this.equipment = equipment;
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