import {loadLS, saveLS} from './ls.js';

export default class Participants {
    constructor() {
        this.list = this.getParticipants();
    }

    getParticipants() {
        let list = loadLS('participants');
        if(!list) {
            list = [];
        }
        return list;
    }

}

class Participant {
    constructor(name, equipment) {
        this.participantName = name;
        this.equipment = equipment;
    }
}