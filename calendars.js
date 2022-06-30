dates = [];

for(var i=0;i<timestamps.length;i++){
  date = new Date(timestamps[i] * 1000).toLocaleDateString('nl-NL');
  dates.push(date);
}

const dayprice = parseFloat(document.getElementById('dag-laag-l').innerHTML);
const weekendprice = parseFloat(document.getElementById('wend-laag-l').innerHTML);
const midweekprice = parseFloat(document.getElementById('mid-laag-l').innerHTML);
const cleaningcosts = parseFloat(document.getElementById('Ccost').innerHTML);
const toeristenbelasting = parseFloat(document.getElementById('Tcost').innerHTML);

function getPrice(begin, end){


  const pricelabel = document.getElementById('pricetag');
  const pricelabel2 = document.getElementById('pricetag2');
  var people = document.getElementById('peopleamount').value;
  var days = [];
  var length = ((end.getTime()-begin.getTime())/(1000 * 3600 * 24)+1);
  for(i=0;i<length;i++){
    days.push(new Date(begin.getTime()+(i*(1000 * 3600 * 24))));
  }
  if(length < 3){
    price = dayprice * length;
  }else if(length < 5){
    var weekend = false;
    for(i=0;i<length-2;i++){
      if(days[i].getDay() == 5){
        weekend = true;
      }
    }
    if(weekend == true){
      price = weekendprice + (length - 3) * dayprice;
    }else{
      price = dayprice * length;
    }
  }else{
    var midweeks = 0;
    var counted = false;
    for(i=0;i<length-4;i++){
      if(days[i].getDay() == 1){
        midweeks = midweeks + 1;
        if(counted == false){
          var firstdayofmidweek = i;
        }
        var lastdayofmidweek = i + 4;
        counted = true;
      }
    }
    if(midweeks > 0){
      var weekendbefore = false;
      var weekendafter = false;
      if(firstdayofmidweek > 2){
        weekendbefore = true;
      }
      if(lastdayofmidweek+2<length){
        weekendafter = true;
      }
      if(weekendafter == true && weekendbefore == true){
        price = midweekprice * midweeks + ((midweeks + 1) * weekendprice) + dayprice * (length - (7 * midweeks + 3));
      }else if(weekendafter == true && weekendbefore == false){
        price = midweekprice * midweeks + (midweeks * weekendprice) + dayprice * (length - (7 * midweeks));
      }else if(weekendafter == false && weekendbefore == true){
        price = midweekprice * midweeks + (midweeks * weekendprice) + dayprice * (length - (7 * midweeks + 1));
      }else if(weekendafter == false && weekendbefore == false){
        price = midweekprice * midweeks + (weekendprice * (midweeks-1)) + dayprice * (length - (7 * midweeks - 2));
      }
    }else{
      var weekend = false;
      for(i=0;i<length-2;i++){
        if(days[i].getDay() == 5){
          weekend = true;
        }
      }
      if(weekend == true){
        price = weekendprice + (length - 3) * dayprice;
      }else{
        price = dayprice * length;
      }
    }
  }
  var totalprice = price + cleaningcosts + people * toeristenbelasting * length;
  pricelabel.value = "€ " + totalprice.toString();
  pricelabel2.value = "€ " + totalprice.toString();
  document.getElementById('pr').value = "€ " + totalprice.toString();
}

const picker1 = new Litepicker({ 
  element: document.getElementById('litepicker1'),
  inlineMode: true,
  plugins: ['mobilefriendly'],
  mobilefriendly: {
    breakpoint: 480,
  },
  lang: "nl",
  numberOfMonths: 2,
  numberOfColumns: 2,
  singleMode: false,
  showTooltip: false,
  format: "D-M-YYYY",
  highlightedDaysFormat: "D-M-YYYY",
  highlightedDays: dates,
  lockDaysFormat: "D-M-YYYY",
  lockDays: dates,
  minDays: 3,
  disallowLockDaysInRange: true,
  switchingMonths: 1
});   

const picker2 = new Litepicker({ 
  element: document.getElementById('litepicker2'),
  plugins: ['mobilefriendly'],
  mobilefriendly: {
    breakpoint: 480,
  },
  lang: "nl",
  numberOfMonths: 2,
  numberOfColumns: 2,
  singleMode: false,
  showTooltip: false,
  format: "D-M-YYYY",
  highlightedDaysFormat: "D-M-YYYY",
  highlightedDays: dates,
  lockDaysFormat: "D-M-YYYY",
  lockDays: dates,
  minDays: 3,
  disallowLockDaysInRange: true,
  setup: (picker2) => {
    picker2.on('selected', (date1, date2) => {
      getPrice(date1, date2);
    });
  },
  switchingMonths: 1
});   

const picker3 = new Litepicker({ 
  element: document.getElementById('litepicker3'),
  plugins: ['mobilefriendly'],
  mobilefriendly: {
    breakpoint: 480,
  },
  lang: "nl",
  numberOfMonths: 2,
  numberOfColumns: 2,
  singleMode: false,
  showTooltip: false,
  format: "D-M-YYYY",
  highlightedDaysFormat: "D-M-YYYY",
  highlightedDays: dates,
  lockDaysFormat: "D-M-YYYY",
  lockDays: dates,
  minDays: 3,
  disallowLockDaysInRange: true,
  setup: (picker3) => {
    picker3.on('selected', (date1, date2) => {
      getPrice(date1, date2);
    });
  },
  switchingMonths: 1
});

function responsiveCalendars(){
  if(window.matchMedia("(max-width: 900px)").matches){
    picker1.setOptions({
      numberOfMonths: 1,
      numberOfColumns: 1
    });
    picker2.setOptions({
      numberOfMonths: 1,
      numberOfColumns: 1
    });
    picker3.setOptions({
      numberOfMonths: 1,
      numberOfColumns: 1
    });
  }else{
    picker1.setOptions({
      numberOfMonths: 2,
      numberOfColumns: 2
    });
    picker2.setOptions({
      numberOfMonths: 2,
      numberOfColumns: 2
    });
    picker3.setOptions({
      numberOfMonths: 2,
      numberOfColumns: 2
    });
  }
}

window.addEventListener('resize', responsiveCalendars);
responsiveCalendars();

document.getElementById('peopleamount').addEventListener('change', function(){
  getPrice(picker2.getStartDate(), picker2.getEndDate());
});
document.getElementById('peopleamount2').addEventListener('change', function(){
  document.getElementById('peopleamount').value = document.getElementById('peopleamount2').value;
  getPrice(picker3.getStartDate(), picker3.getEndDate());
});