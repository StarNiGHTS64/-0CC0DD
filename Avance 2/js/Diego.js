  
  $(document).ready(function(){
    $('.datepicker').datepicker();
  });

 $(document).ready(function(){
    $('.modal').modal();
  });

  $(document).ready(function(){
    $('select').formSelect();
  });

        var iconSelect;

        window.onload = function(){

            iconSelect = new IconSelect("my-icon-select", 
                {'selectedIconWidth':218,
                'selectedIconHeight':218,
                'selectedBoxPadding':1,
                'iconsWidth':45,
                'iconsHeight':45,
                'boxIconSpace':1,
                'vectoralIconNumber':4,
                'horizontalIconNumber':4});

            var icons = [];
            icons.push({'iconFilePath':'../img/user.gif', 'iconValue':'1'});
            icons.push({'iconFilePath':'../img/user_1.gif', 'iconValue':'2'});
            icons.push({'iconFilePath':'../img/user_2.gif', 'iconValue':'3'});
            icons.push({'iconFilePath':'../img/user_3.gif', 'iconValue':'4'});
            icons.push({'iconFilePath':'../img/user_4.gif', 'iconValue':'5'});
            //icons.push({'iconFilePath':'images/icons/5.png', 'iconValue':'5'});
            //icons.push({'iconFilePath':'images/icons/6.png', 'iconValue':'6'});
            //icons.push({'iconFilePath':'images/icons/7.png', 'iconValue':'7'});
            //icons.push({'iconFilePath':'images/icons/8.png', 'iconValue':'8'});
            //icons.push({'iconFilePath':'images/icons/9.png', 'iconValue':'9'});
            //icons.push({'iconFilePath':'images/icons/10.png', 'iconValue':'10'});
            //icons.push({'iconFilePath':'images/icons/11.png', 'iconValue':'11'});
            //icons.push({'iconFilePath':'images/icons/12.png', 'iconValue':'12'});
            //icons.push({'iconFilePath':'images/icons/13.png', 'iconValue':'13'});
            //icons.push({'iconFilePath':'images/icons/14.png', 'iconValue':'14'});
            
            iconSelect.refresh(icons);

        };