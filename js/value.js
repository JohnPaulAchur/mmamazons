function calculation(){
    var first = parseInt(document.getElementById("first").value);
    var second = parseInt(document.getElementById("second").value);
    if (first >=0 && second>=0) {

      var total = document.getElementById('total');
      total.value = first * second ;

      // return total.innerHTML = total ;

    }else {
      document.getElementById('total').value = "";
    }
  }


  function addup(){
    var first = parseInt(document.getElementById("pos").value);
    var second = parseInt(document.getElementById("cash").value);
    var third = parseInt(document.getElementById("trans").value);
    var fourth = parseInt(document.getElementById("exp").value);
    var fifth = parseInt(document.getElementById("others").value);
    var sixth = parseInt(document.getElementById("excess").value);

    if (first >=0 || second>=0 || third>=0 || fourth>=0 || fifth>=0 || sixth>=0) {

      var total = document.getElementById('total');
      total.value =  first+second+third+fourth+fifth+sixth;

      // return total.innerHTML = total ;

    }else {
      // document.getElementById('total').value = "";
    }
  }

  function minus(){
    var stock = parseInt(document.getElementById('quant').value);
    var disp = parseInt(document.getElementById('disp').value);
    var rem = document.getElementById("rem");
    if (disp > 0  ) {
      

      rem.value = (stock-disp);
      
    }else{}
    

    

      
      

      // return total.innerHTML = total ;

    
  }