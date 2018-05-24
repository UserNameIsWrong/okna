<?php
/**
 * Created by PhpStorm.
 * User: Kortez
 * Date: 2018-01-05
 * Time: 17:29
 */
?>


<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body{display: block}
        .m{display: block; background-color: white; position: relative;}
        div{background-color: bisque; width: 300px; height: 100px; margin: 5px}
        .moved{display: block; position: absolute;}
        #pppp{background-color: lightblue; right: 5px; top: 5px; position: fixed; height: auto}


    </style>
</head>
<div class="m" id="mm">NR1<br/>
    <div class="moved" id="ww">">"fsdfsdfsdfsdfds</div>
    <div class="moved" id="ss">@#$$32432432423</div>
    <div class="moved" >{}{}}[]e[f]dsfds</div>
</div>

<div class="m" id="m">NR2<br/>
<div class="moved" id="w">">"fsdfsdfsdfsdfds</div>
<div class="moved" id="s">@#$$32432432423</div>
    <div class="moved" >{}{}}[]e[f]dsfds</div>
</div>
<div id="pppp">
<p id="x">12213213</p>
<p id="xx"></p>
<p id="y"></p>
<p id="z"></p>
<p id="p"></p>
</div>
<script type="text/javascript">
    window.addEventListener("mousemove", test, false);
    function test(e) {
        var m= document.getElementById('xx');
        m.innerText= e.clientX + ' - ' + e.clientY;
    }
    var moveEl= {

        clicEl: null,
        posTop: function () {
            var elTop, parentt;
            elTop= this.clicEl.offsetTop;
            parentt= this.clicEl.offsetParent;
            if(parentt != null){
            while (parentt.offsetTop > 0){
                elTop += parentt.offsetTop;
                parentt= parentt.offsetParent;
            }}
            return elTop;
        },

        posLeft: function () {
            var elLeft, parentt;
            elLeft= this.clicEl.offsetLeft;
            parentt= this.clicEl.offsetParent
            if(parentt != null){
            while (parentt.offsetLeft > 0){
                elLeft += parentt.offsetLeft;
                parentt= parentt.offsetParent;
            }}
            return elLeft;
        }
    }

    function down(e) {
        if(e.target.className == 'moved') {
            var msg;
            moveEl.clicEl = e.target;
            moveEl.cx = e.clientX;
            moveEl.cy = e.clientY;
            e.stopPropagation();
            msg = moveEl.posLeft() + '-' + moveEl.posTop() + "mause:" + moveEl.cx + '-' + moveEl.cy;
            moveEl.clicEl.innerText = msg;
            var x= document.getElementById('p');
            x.innerText= 'offset:' + moveEl.clicEl.offsetLeft + '-' + moveEl.clicEl.offsetTop + '_moveEl.cxy: ' + moveEl.cx + '-' + moveEl.cy;
            window.addEventListener('mousemove', move, false);
        }
        e.stopPropagation();
    }
    function up() {
        window.removeEventListener('mousemove', move, false);
        }

    function move(ev) {
        var moove ={
            x: null,
            y: null,
            parent: null,
            newHeight: null,
            newTop: null,
            newLeftt: null
        }
        moove.x= ev.clientX - moveEl.cx;
        moveEl.cx= ev.clientX;
        moove.y= ev.clientY - moveEl.cy;
        moveEl.cy= ev.clientY;

        moove.newTop= moveEl.clicEl.offsetTop + moove.y - 5 ;
        moove.newLeftt= moveEl.clicEl.offsetLeft + moove.x - 5 ;
        moveEl.clicEl.style.left = moove.newLeftt;
        moveEl.clicEl.style.top = moove.newTop;
        moove.parent= moveEl.clicEl.parentNode;

        if(moove.newLeftt + moveEl.clicEl.clientWidth > moove.parent.clientWidth){
            moove.parent.style.width= moove.newLeftt + moveEl.clicEl.clientWidth;
        }
        if(moove.newTop + moveEl.clicEl.clientHeight > moove.parent.clientHeight) {
            moove.parent.style.height = moove.newTop + moveEl.clicEl.clientHeight;
        }

        moveEl.clicEl.innerText= moveEl.posLeft() + '-' + moveEl.posTop()+ 'offset:'+ moveEl.clicEl.offsetLeft+'-'+ moveEl.clicEl.offsetTop;
        document.getElementById('z').innerText='newLT:'+ moove.newLeftt + '_' + moove.newTop + '   ' + moove.x+' '+moove.y +
            ',  ev.xy:' + ev.clientX + '-' +ev.clientY;
    }
   var m, left, topp, parleft, partop;
    m= document.getElementsByClassName('m');
    for(var a=0; a<m.length; a++) {
        m[a].addEventListener('mousedown', down, false);
        window.addEventListener('mouseup', up, false);
    }
</script>
</body>
</html>


