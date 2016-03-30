window.onload = start;

var winner = [];

function start () {
	var content = '';
	var wrapperLeft = document.getElementById('wLeft');
	for ( var i = 1; i < 50; i++ ) {
		content += '<div class="tile" id="t' + i + '">' + i + '</div>';
		if( i % 7 === 0 ) content += '<div style="clear: both;"></div>';
	}
	wrapperLeft.innerHTML = content;
	var data = new Date();
    data.setTime(data.getTime()+(1*1*5*60*1000));           
    var expires = "; expires="+data.toGMTString();
    document.cookie = 'canSafe' + "=" + 0 + expires + "; path=/";
}

var losuj = document.getElementById('losuj');
losuj.addEventListener('click', losowanie, false);
// losuj.onclick = function() {
// 	losowanie();
// };



function losowanie () {
	losuj.removeEventListener('click', losowanie, false);
	if( winner.length < 6 ) {
		losuj.innerHTML = '......';
		setTimeout( losowanie, 1000 );
		var ball = Math.floor( Math.random() * 49 ) + 1; // 1-49
		if( winner.indexOf( ball ) === -1  ){
			winner.push( ball );
			var karta = document.getElementById('t'+ ball);
			karta.className += ' wylosowana';
		}
	} else {
		losuj.innerHTML = 'Again?';
		losuj.addEventListener('click', again, false); 

		// Ciasteczkowy potwór :D
        var data = new Date();
        data.setTime(data.getTime()+(1*1*5*60*1000));           
        var expires = "; expires="+data.toGMTString();
		   
	    document.cookie = 'l1' + "=" + winner[0] + expires + "; path=/";
	    document.cookie = 'l2' + "=" + winner[1] + expires + "; path=/";
	    document.cookie = 'l3' + "=" + winner[2] + expires + "; path=/";
	    document.cookie = 'l4' + "=" + winner[3] + expires + "; path=/";
	    document.cookie = 'l5' + "=" + winner[4] + expires + "; path=/";
	    document.cookie = 'l6' + "=" + winner[5] + expires + "; path=/";
	    document.cookie = 'canSafe' + "=" + 1 + expires + "; path=/";

		}
		
}

function again() {
	for (var i = 0; i < 6; i++) {
		document.getElementById('t'+ winner[i]).className = 'tile';
	}
	losuj.removeEventListener('click', again, false);
	winner = [];
	losowanie();
}

