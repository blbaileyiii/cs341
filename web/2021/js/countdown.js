// Set the date we're counting down to
let datestrYWCamp = "Jul 27, 2021";
let datestrYMCamp = "Jul 27, 2021";
let datestrTrek = "Oct 22, 2021";

let timestrYWCamp = "08:00:00";
let timestrYMCamp = "09:00:00";
let timestrTrek = "15:00:00";

let dateYWCamp = new Date(datestrYWCamp + " " + timestrYWCamp).getTime();
let dateYMCamp = new Date(datestrYMCamp + " " + timestrYMCamp).getTime();
let dateTrek = new Date(datestrTrek + " " + timestrTrek).getTime();

// TODO: Only add the element to the camps array below based on the page...Home = all, other pages = only the specific one.
let urlParms = new URLSearchParams(window.location.search);
let action = urlParms.get('action');

class Camp {
  constructor(name, date, datestr) {
    this.name = name;
    this.date = date;
    this.datestr = datestr;
  }
}

let camps;
switch(action){
  case 'ymcamp':
    camps = {'ym': new Camp("YMCamp", dateYMCamp, datestrYMCamp)};
    break;
  case 'ywcamp':
    camps = {'yw': new Camp("YWCamp", dateYWCamp, datestrYWCamp)};
    break;
  case 'trek':
    camps = {'trek': new Camp("Trek", dateTrek, datestrTrek)};
    break;
  default:
    camps = {'yw': new Camp("YWCamp", dateYWCamp, datestrYWCamp),
             'ym': new Camp("YMCamp", dateYMCamp, datestrYMCamp),
             'trek': new Camp("Trek", dateTrek, datestrTrek)
            };
    break;
}

//Build HTML
// Get countdown-data element
let countdownEl = document.querySelector('.countdown-data');

for (camp in camps){
  let campDiv = document.createElement('div');
  let timeDiv = document.createElement('div');
  let dateDiv = document.createElement('div');
  let registerDiv = document.createElement('div');

  campDiv.classList.add("countdown");
  timeDiv.classList.add("time-block");

  campDiv.innerHTML = "<h2><div class='camp-yr-logo'><span class='logo-lg logo-highlight'>" + camps[camp].name + "</span><span class='logo-sm'>2021</span></div></h2>";

  timeDiv.innerHTML = "<div class='time-part'><div id='" + camp + "-cd-days' class='time-txt'></div><div class='time-unit'>Days</div></div>";
  timeDiv.innerHTML += "<div class='time-part'><div id='" + camp + "-cd-hours' class='time-txt'></div><div class='time-unit'>Hours</div></div>";
  timeDiv.innerHTML += "<div class='time-part'><div id='" + camp + "-cd-minutes' class='time-txt'></div><div class='time-unit'>Minutes</div></div>";
  timeDiv.innerHTML += "<div class='time-part'><div id='" + camp + "-cd-seconds' class='time-txt'></div><div class='time-unit'>Seconds</div></div>";

  dateDiv.innerHTML = "<div class='date'>" + camps[camp].datestr + "</div>";

  registerDiv.innerHTML = "<a class='button' href='/2021/registration' title='Registration'>Register</a>"
  
  campDiv.appendChild(timeDiv);
  campDiv.appendChild(dateDiv);
  countdownEl.appendChild(campDiv);
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