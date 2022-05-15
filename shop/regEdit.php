<div width="300">
  <form id="regForm" method="POST" action="acc.php?mode=change">
    <div class="row">
      <div class="col">
        <input type="text" id="name" value='<?php echo "$userData->name" ?>' name="name" class="form-control" placeholder="Imię">
      </div>
      <div class="col">
        <input type="text" id="surname" value='<?php echo "$userData->surname" ?>' name="surname" class="form-control" placeholder="Nazwisko">
      </div>
    </div><br>
    <div class="row">
      <div class="col">
        <input type="text" id="email" value='<?php echo "$userData->email" ?>' name="email" class="form-control" placeholder="Email">
      </div>
      <div class="col">
        <input type="text" id="phone" value='<?php echo "$userData->phone_number" ?>' name="phone" class="form-control" placeholder="Numer Telefonu">
      </div>
    </div><br>
    <div class="row">
      <div class="col">
        <input type="text" id="address" value='<?php echo "$userData->address" ?>' name="address" class="form-control" placeholder="Adres">
      </div>
      <div class="col">
        <input type="text" id="hnumber" value='<?php echo "$userData->house_number" ?>' name="hnumber" class="form-control" placeholder="Numer domu">
      </div>
    </div><br>
    <div class="row">
      <div class="col">
        <input type="text" id="postal" value='<?php echo "$userData->postal_code" ?>' name="postal" class="form-control" placeholder="Kod pocztowy">
      </div>
      <div class="col">
        <select  id="province" name="province" class="form-control" id="province">
        <?php User::getProvince($connect,$userData->province_id) ?>
        </select>
      </div>
    </div><br>
    <div class="row">
      <div class="col">
        <input type="password" id="password" name="password" class="form-control" placeholder="Hasło">
      </div>
      <div class="col">
        <input type="password" id="checkPassword" name="checkPassword" class="form-control" placeholder="Powtórz hasło">
      </div>
    </div><br>
    <div class="row">
      <div class="col">
        <input type="hidden" value='<?php while($r=$all->fetch_object()){
            echo "$r->email,";}?>'>
        <input type="submit" class="form-control" value="Zapisz">
      </div>
    </div>
  </form>
</div>

<script>
  $rf = document.getElementById("regForm");
  $rf.addEventListener("submit",val);

    
    function val(){
    event.preventDefault();

    while(true){
      inp1 = document.querySelector("#name").value;
      inp2 = document.querySelector("#surname").value;
      inp3 = document.querySelector("#email").value;
      inp4 = document.querySelector("#phone").value;
      inp5 = document.querySelector("#address").value;
      inp6 = document.querySelector("#hnumber").value;
      inp7 = document.querySelector("#postal").value;
      inp8 = document.querySelector("#province").value;
      inp9 = document.querySelector("#password").value;
      inp10 = document.querySelector("#checkPassword").value;
      var r1 = /^[A-ZĄĆŁĘÓŃŻŹŚ]{1}[a-ząćłęóńżźś]{2,}$/;
      if(!r1.test(inp1)){
        alert("Imię nie spełnia wymagań!");
        break;
      }
      if(!r1.test(inp2)){
        alert("Nazwisko nie spełnia wymagań!");
        break;
      }
      var r2 = /^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,3}$/;
      if(!r2.test(inp3)){
        alert("Email nie spełnia wymagań!");
        break;
      }
      var r3 = /[0-9]{9}/;
      if(!r3.test(inp4)){
        alert("Numer telefonu nie spełnia wymagań!");
        break;
      }
      var r4 = /\S/;
      if(!r4.test(inp5)){
        alert("Adres nie spełnia wymagań!");
        break;
      }
      var r5 = /[0-9]{1,}/;
      if(!r5.test(inp6)){
        alert("Numer domu nie spełnia wymagań!");
        break;
      }
      var r6 = /^[0-9]{2}-?[0-9]{3}$/;
      if(!r6.test(inp7)){
        alert("Kod pocztowy nie spełnia wymagań!");
        break;
      }
      if(inp8=="brak"){
        alert("Proszę zaznaczyć województwo!");
        break;
      }
      var r7 = /(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:;"'<>,.\/?])(?=.*[a-ząĄćĆęĘłŁńŃóÓśŚźŹżŻ])(?=(.*[A-ZąĄćĆęĘłŁńŃóÓśŚźŹżŻ]))(?=(.*)).{8,}/;
      if(!r7.test(inp9)){
        alert("Hasło nie spełnia wymagań!");
        break;
      }
      if(inp9!=inp10){
        alert("Hasła się różnią!");
        break;
      }
      event.target.submit();
      break;
    }
    
  };
</script>