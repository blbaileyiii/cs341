import {loadLS, saveLS} from './ls.js';

export default class Participants {
    constructor() {
        this.list = this.getParticipants();
        // Validate the list...loop through it and if the participant is gone, remove and update...
    }

    getParticipants() {
        let list = loadLS('participants');
        if(!list) {
            list = [];
        }
        return list;
    }

    

}
