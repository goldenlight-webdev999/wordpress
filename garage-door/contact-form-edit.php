<div class="home-type active">
  <div class="radio-button-wrapper">
      <div class="image-radio">
          <input name="home-type" value="commercial" checked="checked" style="display:none" type="radio"/><img src="/wp-content/uploads/2019/03/commercial.png"><div class="radio-label">Commercial</div>
      </div>
      <div class="image-radio">
          <input name="home-type" value="residential" style="display:none" type="radio"/><img src="/wp-content/uploads/2019/03/residential.png"><div class="radio-label">Residential</div>
      </div><div class="clr"></div>
  </div>
  <div class="form-nav">
    <a hre="#" id="home-type-next" class="btn next" onclick="homeNextFunction(); return false;">Next >></a><div class="clr"></div>
  </div>  
</div>
<div class="door-type inactive">
  <div class="radio-button-wrapper">
      <div class="image-radio">
          <input name="door-type" value="garage-door" checked="checked" style="display:none" type="radio"/><img src="/wp-content/uploads/2019/03/residential.png"><div class="radio-label">Garage Door</div>
      </div>
      <div class="image-radio">
          <input name="door-type" value="gate" style="display:none" type="radio"/><img src="/wp-content/uploads/2019/03/commercial.png"><div class="radio-label">Gate</div>
      </div><div class="clr"></div>
  </div>
  <div class="form-nav">
    <a hre="#" id="door-type-pre" class="btn pre" onclick="doorPreFunction()"><< Prev</a><a hre="#" id="door-type-next" class="btn next" onclick="doorNextFunction()">Next >></a><div class="clr"></div>
  </div>  
</div>
<div class="info-entry inactive">
  <label> Your Name (required)
      [text* your_name] </label>
  <label> Your Phone Number (required)
      [tel* your_phone] </label>
  <label> Your Email (required)
      [email* your_email] </label>
  <div class="form-nav">
    <a hre="#" id="info-entry-next" class="btn pre" onclick="infoPreFunction()"><< Prev</a><a hre="#" id="info-entry-next" class="btn next" onclick="infoNextFunction()">Next >></a><div class="clr"></div>  
  </div>
</div>
<div class="comments-entry inactive">
  <label> Comments
      [textarea comments placeholder] </label>
  <div class="form-nav">
    <a hre="#" id="comments-entry-pre" class="btn pre" onclick="commentsPreFunction()"><< Prev</a>[submit id:send class:next class:btn "Send"]
    <div class="clr"></div>      
  </div>  
</div>
<style>
  .inactive {display:none;}
  .active {display:block;}
</style>
<script>
  function homeNextFunction(){
     jQuery(".home-type").removeClass("active");
     jQuery(".home-type").addClass("inactive");
     jQuery(".door-type").removeClass("inactive");
     jQuery(".door-type").addClass("active");
  }
  function doorPreFunction(){
     jQuery(".home-type").removeClass("inactive");
     jQuery(".home-type").addClass("active");
     jQuery(".door-type").removeClass("active");
     jQuery(".door-type").addClass("inactive");
  }
  function doorNextFunction(){
     jQuery(".door-type").removeClass("active");
     jQuery(".door-type").addClass("inactive");
     jQuery(".info-entry").removeClass("inactive");
     jQuery(".info-entry").addClass("active");
  }
  function infoPreFunction(){
     jQuery(".info-entry").removeClass("active");
     jQuery(".info-entry").addClass("inactive");
     jQuery(".door-type").removeClass("inactive");
     jQuery(".door-type").addClass("active");
  }
  function infoNextFunction(){
     jQuery(".info-entry").removeClass("active");
     jQuery(".info-entry").addClass("inactive");
     jQuery(".comments-entry").removeClass("inactive");
     jQuery(".comments-entry").addClass("active");
  }
  function commentsPreFunction(){
     jQuery(".comments-entry").removeClass("active");
     jQuery(".comments-entry").addClass("inactive");
     jQuery(".info-entry").removeClass("inactive");
     jQuery(".info-entry").addClass("active");
  }
  jQuery(".image-radio img").click(function(){
    jQuery(this).prev().attr('checked',true);
  });
</script>