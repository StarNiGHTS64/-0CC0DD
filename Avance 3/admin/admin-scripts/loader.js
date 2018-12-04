function getScript(source,option){
    switch(option){
        case 1:
            alert("hello world");
            var s = document.createElement("script");
                s.type = "text/javascript";
                s.src  = source;
                s.innerHTML = null;
                s.id = "switcheroo";
                document.getElementById("area").innerHTML = "";
                document.getElementById("area").appendChild(s);
        break;
        default:
            void(0);
    }
}