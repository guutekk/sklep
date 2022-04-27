function getSelectItemThat(id) {

    if(id==1 || id==2 || id==3)
    {
        console.log(id);
        for (var i = 1;i <= 3; i++)
        {
            console.log(id);
            document.getElementById(i).checked = false;
        }
        console.log(id);
        document.getElementById(id).checked = true;

    }
    
    if(id==4 || id==5 || id==6)
    {
        console.log(id);
        for (var i = 4;i <= 6; i++)
        {
            console.log(i);
            document.getElementById(i).checked = false;
        }
        console.log(id);
        document.getElementById(id).checked = true;
    }
}