window.onload=setTimeout(function(){
  if ( /\.atlassian\.net\/wiki\//.test(window.location.href) == true ) { //if its confluence, make the td.code editable
    var contenteditableBlock = document.querySelectorAll("td[class^=code]");
  } else { //if its not confluence, make the pre tag editable
    var contenteditableBlock = document.querySelectorAll("pre");
  }
  for(i = 0; i < contenteditableBlock.length; i++) {
    contenteditableBlock[i].setAttribute("contenteditable", "true");
  }
}, 2000); //for some reason we need a 2 sec delay after the document_end finishes for confluence to work