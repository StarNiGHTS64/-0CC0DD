function getScript(source,option){
    window.addEventListener("load",function(event){
        switch(option){
            case 1:
                var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.src  = source;
                    s.innerHTML = null;
                    s.id = "switcheroo";
                    document.getElementById("area").innerHTML = "";
                    document.getElementById("area").appendChild(s);
                break;
                
            case 2:
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
    });
}