/* =================================================== **
*                  FUNCTIONS LIBRARY                    *
** =================================================== */
/* Auteur    : Thierry CHARPENTIER                      *
*  Date      : 29.07.2018                               *
*  Version   : V1R0                                     *
*
/* --- =========================================== --- **
**     EXTERNAL RESSOURCE DONWNLOADING                 **
** --- =========================================== --- */
function downloadUrl(url, callback) {
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        /* 
        0: Object XHR was created, but not initialized yet (the open method was not called yet)
        1: Object XHR was created, but not sent yet (with the method send)
        2: The method send has just been called
        3: The waiter processes the data and started to return data
        4: The waiter finished its work, and all the data are delivered
        */
        if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText, xhr.status);
        }
    }
    xhr.open("GET", url, true);
    xhr.send(null);
}
function getXMLHttpRequest() {
    var xhr = null;
    if(window.XMLHttpRequest || window.AciveXOject) {
        if(window.ActiveXOject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Votre navigateur ne support pas l'objet XMLHTTPRequest");
        return null;
    }
    return xhr;
}
function xmlParse(str) {
    if(typeof ActiveXObject != 'undefined' && typeof GetObject != 'undefined') {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
    }
    if(typeof DOMParser != 'undefined') {
        return (new DOMParser()).parseFromString(str, 'text/xml');
    }
}
/* --- =========================================== --- **
**    TO OBTAIN THE PUNCTUAL COORDINATES FLIES OVER    **
**    BY THE CURSOR                                    **
** --- =========================================== --- */
function getCoordsCursor(canvas, evt) {
    var rect = canvas.getBoundingClientRect();          // return the size of an element and its relative position compared to the zone of posting (viewport)
    return {
      left: Math.round(evt.clientX - rect.left),
      top: Math.round(evt.clientY - rect.top)
    };
}
/* --- =========================================== --- **
**           TESTING FOR STORAGE AVAILABILITY          **
** --- =========================================== --- */
function storageAvailable(type) {
    try {
        var storage = window[type],x = '__storage_text__';
        storage.setItem(x,x);
        storage.removeItem(x);
        return true;
    } catch(e) {
        return e instanceof DOMException && (
            e.code === 22 || e.code === 1014 || 
                e.name === 'QuotaExceedError' || e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
            storage.length !== 0; 
    }
}
/* --- =========================================== --- **
**               SETTING VALUES IN STORAGE             **
** --- =========================================== --- */
function settingLocalStorage(data) {
    for(var key in data) {
        if(data.hasOwnProperty(key)) {
            localStorage.setItem(key, data[key]);
        }
    }
}
/* --- =========================================== --- **
**                CLEAR ENTIRE STORAGE                 **
** --- =========================================== --- */
function clearLocalStorage() {
    localStorage.clear();
}

/* --- =========================================== --- **
**                    DATE 2 STRING                    **
** --- =========================================== --- */
Date.prototype.yyyymmdd = function() {
    var yyyy = this.getFullYear();
    var mm = this.getMonth() < 9 ? '0' + (this.getMonth() + 1) : (this.getMonth() + 1); 
    var dd = this.getDate() < 10 ? '0' + this.getDate() : this.getDate();
    return "".concat(yyyy).concat(mm).concat(dd);
}
Date.prototype.yyyymmddhhmm = function() {
    var yyyy = this.getFullYear();
    var mm = this.getMonth() < 9 ? '0' + (this.getMonth() + 1) : (this.getMonth() + 1); 
    var dd = this.getDate() < 10 ? '0' + this.getDate() : this.getDate();
    var hh = this.getHours() < 10 ? '0' + this.getHours() : this.getHours();
    var min = this.getMinutes() < 10 ? '0' + this.getMinutes() : this.getMinutes();
    return "".concat(yyyy).concat(mm).concat(dd).concat(hh).concat(min);
}
Date.prototype.yyyymmddhhmmss = function() {
    var yyyy = this.getFullYear();
    var mm = this.getMonth() < 9 ? '0' + (this.getMonth() + 1) : (this.getMonth() + 1); 
    var dd = this.getDate() < 10 ? '0' + this.getDate() : this.getDate();
    var hh = this.getHours() < 10 ? '0' + this.getHours() : this.getHours();
    var min = this.getMinutes() < 10 ? '0' + this.getMinutes() : this.getMinutes();
    var sec = this.getSeconds() < 10 ? '0' + this.getSeconds() : this.getSeconds();
    return "".concat(yyyy).concat(mm).concat(dd).concat(hh).concat(min).concat(sec);
}
Date.prototype.toStringDate = function() {
    var shortMonthNames = new Array();
    shortMonthNames = {1: 'Jan', 2: 'Feb', 3: 'Mar', 4: 'Apr', 5: 'May', 6: 'Jun', 
        7: 'Jul', 8: 'Aug', 9: 'Sep', 10: 'Oct', 11: 'Nov', 12: 'Dec'};
    var year = this.getFullYear();
    var month = shortMonthNames[this.getMonth()];
    var day = this.getDate();
    var hour = this.getHours() < 10 ? '0' + this.getHours() : this.getHours();
    var min = this.getMinutes() < 10 ? '0' + this.getMinutes() : this.getMinutes();
    var sec = this.getSeconds() < 10 ? '0' + this.getSeconds() : this.getSeconds();
    return "".concat(month).concat(' ').concat(day).concat(' ').
        concat(hour).concat(':').concat(min).concat(':').concat(sec).
        concat(' ').concat(year);
}
/* --- =========================================== --- ** 
**              FIRST LETTER CAPITALIZING              **
** --- =========================================== --- */
function capitalize(str) {
    return str.substr(0,1).toUpperCase() + str.substr(1);
}

/* --- =========================================== --- ** 
**   CONVERSION OF ARAB NUMERALS INTO ROMAN NUMERALS   **
** --- =========================================== --- */
function AtoR( nb ){
    var A = [ 1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1 ],
	R = [ "M", "CM", "D", "CD", "C", "XC", "L", "XL", "X", "IX", "V", "IV", "I" ],
	Alength = A.length;
	var x = parseInt( nb, 10 ) || 1, str = "";
 
	if ( x < 1 ){x = 1;} else if ( x > 3999 ){x = 3999;}
 
	for ( var i = 0; i < Alength; ++i ){
		while ( x >= A[ i ] ){
			x -= A[ i ];
			str += R[ i ];
		}
 
		if ( x == 0 ){
			break;
		}
	}
 
	return str;
}
 
/* --- =========================================== --- ** 
**   CONVERSION OF ROMAN NUMERALS INTO ARAB NUMERALS   **
** --- =========================================== --- */
function RtoA( str ){
    var A = [ 1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1 ],
	R = [ "M", "CM", "D", "CD", "C", "XC", "L", "XL", "X", "IX", "V", "IV", "I" ],
	Alength = A.length;
	if ( ( typeof str != "string" ) || ( str.length < 1 ) ) return;
 
	var x = 0,
		item = "";

	for ( var i = 0; i < Alength; ++i ){
 
		while ( str.length >= R[ i ].length ){
			item = str.slice( 0, R[ i ].length );
 
			if ( R[ i ] == item ){
				x += A[ i ];
				str = str.substring( R[ i ].length );
			} else {
				break;
			}
		}
	}
 
	return x;
}