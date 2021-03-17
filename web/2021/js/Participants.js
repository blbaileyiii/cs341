import {loadLS, saveLS} from './ls.js';

export default class Participants {
    constructor() {
        this.participants = this.getParticipants();
    }

    getParticipants() {
        let participants = loadLS("participants");
        if(!participants) {
            participants = [];
        }
        return participants;
    }

}

class Participant {
    constructor(name, equipment) {
        this.participantName = name;
        this.equipment = equipment;
    }
}