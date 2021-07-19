// TODO: Only add the element to the camps array below based on the page...Home = all, other pages = only the specific one.
let urlParms = new URLSearchParams(window.location.search);
let action = urlParms.get('action');
let camps = {};

getEvents();

function getEvents() {
  let url = "/2021/query/?action=getEvents";
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      //do stuff with data...
      if (this.readyState == 4 && this.status == 200) {
          let myDBRes = JSON.parse(this.responseText);
          // console.log(myDBRes);
          createCountdown(myDBRes);
          //
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

class Camp {
  constructor(id, name, date, year, datestr, locked) {
    this.id = id;
    this.name = name;
    this.date = date;
    this.year = year;
    this.datestr = datestr;
    this.locked = locked;
  }
}

function createCountdown(eventList){
	// console.log(eventList);
	if (eventList.length > 0) {
		eventList.forEach(event => {
			// console.log(event);
      // console.log(event.key);
      // console.log(action);
    
      if(action){
        if(event.key == action){
          camps[event.key] = createCamp(event);
        }        
      } else {
        camps[event.key] = createCamp(event);
      }      
		});
	}

  // console.log(camps);
  buildCountdownHTML();
}

function createCamp(event) {
  let campId = event.id;
  let eventStartDate = event.date_start;
  let eventTime = event.meet_time;
  let eventDate= new Date(eventStartDate + 'T' + eventTime);

  let eventBTime = eventDate.getTime();
  let month = eventDate.getMonth() + 1;
  let day = eventDate.getDate();
  let year = eventDate.getFullYear();
  let eventDateFormated = month + "/" + day + "/" + year;

  let campName = event.name.replace(year, "").trim();

  let locked = event.locked;

  let camp = new Camp(campId, campName, eventBTime, year, eventDateFormated, locked);

  return camp;
}

function buildCountdownHTML(){
  //Build HTML
  // Get countdown-data element
  let countdownEl = document.querySelector('.countdown-data');

  for (camp in camps){
    // console.log(camp)
    let campDiv = document.createElement('div');
    let timeDiv = document.createElement('div');
    let dateDiv = document.createElement('div');
    let registerDiv = document.createElement('div');
    let a = document.createElement('a');

    campDiv.classList.add('countdown');
    timeDiv.classList.add('time-block');

    campDiv.innerHTML = "<h2><div class='camp-yr-logo'><span class='logo-lg logo-highlight'>" + camps[camp].name + "</span><span class='logo-sm'>" + camps[camp].year + "</span></div></h2>";

    timeDiv.innerHTML = "<div class='time-part'><div id='" + camp + "-cd-days' class='time-txt'></div><div class='time-unit'>Days</div></div>";
    timeDiv.innerHTML += "<div class='time-part'><div id='" + camp + "-cd-hours' class='time-txt'></div><div class='time-unit'>Hours</div></div>";
    timeDiv.innerHTML += "<div class='time-part'><div id='" + camp + "-cd-minutes' class='time-txt'></div><div class='time-unit'>Minutes</div></div>";
    timeDiv.innerHTML += "<div class='time-part'><div id='" + camp + "-cd-seconds' class='time-txt'></div><div class='time-unit'>Seconds</div></div>";

    dateDiv.classList.add('date-block');
    dateDiv.innerHTML = "<div class='date'>" + camps[camp].datestr + "</div>";

    registerDiv.classList.add('register-block');

    let linkText;
    
    if (camp.locked) {
      linkText = document.createTextNode("Register");
      a.title = "Register";
    } else {
      linkText = document.createTextNode("LOCKED");
      a.title = "Register: LOCKED";
    }
    a.appendChild(linkText);   
    a.href = "/2021/registration?eventId=" + camps[camp].id;
    a.classList.add('button')

    registerDiv.appendChild(a);
    campDiv.appendChild(timeDiv);
    campDiv.appendChild(dateDiv);
    campDiv.appendChild(registerDiv);
    countdownEl.appendChild(campDiv);
  }

}


// Update the count down every 1 second
let x = setInterval(countDown, 1000);

function countDown() {
  // Get today's date and time
  let now = new Date().getTime();

  let campsPassed = 0;

  for (camp in camps){
    // Find the distance between now and the count down date
    let distance = camps[camp].date - now;

    // Time calculations for days, hours, minutes and seconds
    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
    // Output the result in an element with id="ym"
    document.getElementById(camp + "-cd-days").innerHTML = days;
    document.getElementById(camp + "-cd-hours").innerHTML = hours;
    document.getElementById(camp + "-cd-minutes").innerHTML = minutes;
    document.getElementById(camp + "-cd-seconds").innerHTML = seconds;
          
    // If the count down is over, write some text 
    if (distance < 0) {
      campsPassed++;
      document.getElementById(camp + "-cd-days").innerHTML = 0;
      document.getElementById(camp + "-cd-hours").innerHTML = 0;
      document.getElementById(camp + "-cd-minutes").innerHTML = 0;
      document.getElementById(camp + "-cd-seconds").innerHTML = 0;
    }
  }

  // If the count down is over, write some text 
  if (campsPassed >= camps.length) {
    clearInterval(x);
  }
}
