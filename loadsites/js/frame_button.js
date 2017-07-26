function frame_resize() {
    var x = document.getElementsByTagName('iframe');
    var i;
    var site = document.getElementsByClassName("site");
    for (i = 0; i < x.length; i++) {
    if (x[i].style.width === '100%') {
        x[i].style.width = '500px';
        x[i].style.height = '300px';
        document.getElementsByTagName('button')[0].innerHTML = "enlarge frames";
        site[i].style.float = 'left';
        site[i].style.padding = '15px 10px';
    } else {
        x[i].style.width = '100%';
        x[i].style.height = '500px';
        document.getElementsByTagName('button')[0].innerHTML = "minimize frames";
        site[i].style.float = 'none';
        site[i].style.padding = '15px 50px';
    }
    }
}
