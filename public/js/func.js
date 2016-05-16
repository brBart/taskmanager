

function isNumber(obj) { 
	return !isNaN(parseFloat(obj)) 
}

String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
} 


String.prototype.toJson = function(){
	return JSON.stringify(JSON.parse(this),null,2);
}


function parseDate( input ='' ){
	if(input != ''){
		var date_time = input.split(' ');
		var ymd = date_time[0].split('-');
		var hms = date_time[1].split(':');
		
		return new Date(ymd[0] ,ymd[1]-1 , ymd[2] , hms[0] , hms[1] , hms[2]);
	}else{

		return 0;
	}
}



var contains = function(needle) {
    var findNaN = needle !== needle;
    var indexOf;

    if(!findNaN && typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;

            for(i = 0; i < this.length; i++) {
                var item = this[i];

                if((findNaN && item !== item) || item === needle) {
                    console.log(item+'---'+needle);
                    index = i;
                    break;
                }
            }

            return index;
        };
    }

    return indexOf.call(this, needle) > -1;
};
