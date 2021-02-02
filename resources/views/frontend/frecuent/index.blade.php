@extends('frontend/layouts.app')

@section('content')
<link rel="stylesheet" href="/css/frontend/faqs.css">
<div class=" container-fluid">





  <div class="row pt-5 mb-5 justify-content-center text-right">

    <div class="col ">
      <h2 style="font-size: 25px;color:#000;" class="font-weight-bold text-center">Preguntas Frecuentes</h2>

    </div>

  </div>

  <div style="margin-top: 10px;" id="section-faqs" class="container ">
    <div class="row">
      

      <div class="col-12 faq">
        <h2 class="faqs-head"><a onclick="displayText(1)" href="">1. ¿Pregunta 1?<span id="sign-1" class="float-right">+</span></a> </h2>
        <p id="1" style="display: none;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur distinctio fuga sed voluptate omnis consectetur in, sunt totam cumque consequatur delectus, autem assumenda numquam aspernatur inventore fugiat quas! Aperiam, quisquam.</p>
      </div>

      <div class="col-12 faq">
        <h2 class="faqs-head"><a onclick="displayText(2)" href="">2. ¿Pregunta 2?<span id="sign-2" class="float-right"><b>+</b></span></a> </h2>
        <p id="2" style="display: none;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi error at dolore repellendus vitae, iure modi quos fugit ab. Iure tempora expedita id quo ducimus esse quos, dolor cum cupiditate.</p>
      </div>

      <div class="col-12 faq">
        <h2 class="faqs-head"><a onclick="displayText(3)" href="">3. ¿Pregunta 3?<span id="sign-3" class="float-right"><b>+</b></span></a> </h2>
        <p id="3" style="display: none;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, eligendi. Ipsam, modi nemo voluptas reiciendis, id aliquam enim quisquam numquam dolore dolor fugiat. Quis provident, nobis sit explicabo illum est?</p>
      </div>

      <div class="col-12 faq">
        <h2 class="faqs-head"><a onclick="displayText(4)" href="">4. ¿Pregunta 4?<span id="sign-4" class="float-right"><b>+</b></span></a> </h2>
        <p id="4" style="display: none;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio veritatis quidem culpa neque? Commodi voluptas quidem odio a neque similique doloremque id reiciendis cum maxime, tempora, saepe pariatur quibusdam possimus.</p>
      </div>

      <div class="col-12 faq">
        <h2 class="faqs-head"><a onclick="displayText(5)" href="">5. ¿Pregunta 5?<span id="sign-5" class="float-right"><b>+</b></span></a> </h2>
        <p id="5" style="display: none;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente labore ipsa esse accusamus, numquam quod, fugiat nesciunt exercitationem necessitatibus est ut itaque dolorum adipisci! Sit perferendis laudantium dignissimos ad beatae!</p>
      </div>

      <div class="col-12 faq">
        <h2 class="faqs-head"><a onclick="displayText(6)" href="">6. ¿Pregunta 6?<span id="sign-6" class="float-right"><b>+</b></span></a> </h2>
        <p id="6" style="display: none;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident, eveniet. Fugit architecto illum iusto pariatur repellat tempora. Non ipsa ex iure sed unde, optio ea architecto culpa! Quidem, excepturi dolores.</p>
      </div>

      <div class="col-12 faq">
        <h2 class="faqs-head"><a onclick="displayText(7)" href="">7. ¿Pregunta 7?<span id="sign-7" class="float-right"><b>+</b></span></a> </h2>
        <p id="7" style="display: none;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias, soluta. Nostrum neque veritatis, odit facere harum eius, accusantium, assumenda iusto soluta officia eum ex dolores totam asperiores alias sint qui?
        </p>
      </div>


    </div>
  </div>

</div>
<script>
  $( document ).ready(function() {
  $('#headFav').fadeIn(400);
});
</script>

<script>
  function displayText(faq)
        {
          event.preventDefault();
          if($('#'+faq).css("display") == 'none')
          {
            $('#'+faq).slideDown();
            $('#sign-'+faq).text('-');
          }
          else{
            $('#'+faq).slideToggle();
            $('#sign-'+faq).text('+');
          }
          
        }
      </script>
@endsection