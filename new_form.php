<?php

$spec_number = $globalVars["spec_number"];
$spec = false;
if(trim($spec_number) != ""){
   
   $selectedSpec = getSpecs($spec_number);
	
   foreach($selectedSpec as $currSpec){
      $objectVars = get_object_vars($currSpec);
		$columnList = array_keys($objectVars);
		foreach($columnList as $currColumn){
                                    
         // Don't change the record ID
         if($currColumn != "recordID")
		      $globalVars[$currColumn] = $currSpec->$currColumn;
         }
		   
         $spec=true;
	   }
   }
   else{
      
      $spec_number = "Customer";
      $globalVars["spec_number"] = "Customer";
}

   //set meta data for responsive form
   $document = &JFactory::getDocument();

   //set viewport and force browser version to be used
   $document->setMetaData( 'viewport', 'width=device-width, initial-scale=1.0' );
   $document->setMetaData( 'X-UA-Compatible', 'IE=Edge,chrome=1', true); 
   $document->setMetaData( 'apple-mobile-web-app-capable' );
   
   //include css for bootstrap
   $document->addStyleSheet('/components/com_chassis_checkin/assets/css/bootstrap.css');
   $document->addStyleSheet('/components/com_chassis_checkin/assets/css/checkincss.css');

?>
<!--<link href="formCSS.css" rel="stylesheet" type="text/css" />-->

<script type="text/JavaScript">
  function MM_findObj(n, d) { //v4.01
     var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
       d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
     if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
     for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
     if(!x && d.getElementById) x=d.getElementById(n); return x;
   }
   
   function submitCheckin(actionvalue)
   {
       document.entercheckin.action.value = actionvalue;
       document.entercheckin.submit();
   }
   
   function changeSpec(formObject)
   {
       formObject.view.value = '';
       formObject.submit();
   }
   
   function MM_validateForm() { //v4.0
     var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
     for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
       if (val) { nm=val.name; if ((val=val.value)!="") {
         if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
           if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
         } else if (test!='R') { num = parseFloat(val);
           if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
           if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
             min=test.substring(8,p); max=test.substring(p+1);
             if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
       } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
     } if (errors) alert('The following error(s) occurred:\n'+errors);
     document.MM_returnValue = (errors == '');
   }
</script>

<script type="text/javascript" language="JavaScript">
  function trColorOn(elementId) {
    if (document.getElementById) {
      document.getElementById(elementId).style.backgroundColor = "#ccffcc"
    }
  }

  function trColorOff(elementId) {
    if (document.getElementById) {
      document.getElementById(elementId).style.backgroundColor = ""
    }
  }
</script>

<!--
   ##FORMFIELD_orig_mfg_date##
   ##FORMFIELD_mileage##
   ##FORMFIELD_cust_truck_num##
   ##FORMFIELD_checkin_date##
   ##FORMFIELD_transferCaseMfr##
   ##FORMFIELD_transferCaseModel##
   ##FORMFIELD_front_axle##
   ##FORMFIELD_rear_axle##
-->

<span>
  <?php //echo $display_alert; ?></span>

<?php
function field_set($field_name, $s, $val){

   if( $s === true ){
      
//var_dump( $s );
      
      //var_dump( $field_name );
      //var_dump( $globalVars[ $field_name ] );
      return '<input type="hidden" name="'.$field_name.'" value="' . $val . '">' .$val. "\n";
      }
      else{ 
      
      return '##FORMFIELD_'.$field_name.'##';
      }

}
?>
<form action="/index.php?option=com_chassis_checkin&form=entercheckin" method="POST" enctype="multipart/form-data" name="entercheckin"
  id="entercheckin">
  <?php
if($globalVars["recordID"] != "")
    print '<br><br><span class="warning">This chassis has already been checked in, you are in Edit mode.</span><br><br>';
?>
  <!-- hidden inputs -->
  ##FORMFIELD_mps_prodstatus_id##

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">


        <div class="panel-group" id="accordion1">

          <div class="panel panel-default">

            <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
              <div id="custom-heading-color" class="panel-heading">

                <h4 class="panel-title">Chassis</h4>

              </div>
            </a>

            <div id="collapseOne1" class="panel-collapse collapse">
              <div class="panel-body">


                <div class="well well-lg">
                  <div class="row">
                    <div class="col-sm-12">
                      <h4>Chassis Description</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="chassis_year">Model Year</label></div>
                    <div class="col-sm-6">##FORMFIELD_chassis_year##</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="chassis_make">Chassis Make</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set( 'chassis_make', $spec, $globalVars['chassis_make'] ); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="chassis_model">Chassis Model</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('chassis_model', $spec, $globalVars['chassis_model'] ); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="drive_type">Drive Type</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('drive_type', $spec, $globalVars['drive_type'] ); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="cab_type">Cab Style</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('cab_type', $spec, $globalVars['cab_type'] ); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="color">Color</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('color', $spec, $globalVars['color'] ); ?>
                    </div>
                  </div>
                </div>

                <div class="well well-lg">
                  <div class="row">
                    <div class="col-sm-12">
                      <h4>Engine Information</h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6"><label for="engine_make">Engine Make</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('engine_make', $spec, $globalVars['engine_make'] ); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="engine_model">Engine Model</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('engine_model', $spec, $globalVars['engine_model'] ); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="engine_size">Engine Size</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('engine_size', $spec, $globalVars['engine_size'] ); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="engine_hp">Engine HP</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('engine_hp', $spec, $globalVars['engine_hp'] ); ?>
                    </div>
                  </div>
                </div>
                <div class="well well-lg">
                  <div class="row">
                    <div class="col-sm-12">
                      <h4>Transmission Information</h4>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-sm-6"><label for="transmission_make">Transmission Make</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('transmission_make', $spec, $globalVars['transmission_make'] ); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="transmission_model">Transmission Model</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('transmission_model', $spec, $globalVars['transmission_model'] ); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="transmission_type">Transmission Type</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('transmission_type', $spec, $globalVars['transmission_type'] ); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="transmission_speeds">Transmission Speeds</label></div>
                    <div class="col-sm-6">
                      <?php echo field_set('transmission_speeds', $spec, $globalVars['transmission_speeds'] ); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12"><label>PTO Openings</label></div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6"><label>##FORMFIELD_lPTOOpening##</label></div>
                    <div class="col-sm-6"><label>##FORMFIELD_rPTOOpening##</label></div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4"><label>##FORMFIELD_tPTOOpening##</label></div>
                    <div class="col-sm-4"><label>##FORMFIELD_bPTOOpening##</label></div>
                    <div class="col-sm-4"><label>##FORMFIELD_nPTOOpening##</label></div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6"><label for="PTOPattern">PTO Pattern</label></div>
                    <div class="col-sm-6">##FORMFIELD_PTOPattern##</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="numPTOs">Number of PTOs</label></div>
                    <div class="col-sm-6">##FORMFIELD_numPTOs##</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="auto_neutral">Auto Neutral</label></div>
                    <div class="col-sm-6">##FORMFIELD_auto_neutral##</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6"><label for="all_wheel_drive">All Wheel Drive</label></div>
                    <div class="col-sm-6">##FORMFIELD_all_wheel_drive##</div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-sm-8">&nbsp;</div>
                  <div class="col-sm-4">
                    <a href="javascript:submitCheckin('save');" class="btn" id="btn">Save</a>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div> <!-- Chassis Group -->

        <div class="panel panel-default">
          <a data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1">
            <div id="custom-heading-color" class="panel-heading">
              <h4 class="panel-title">Fuel & Exhaust</h4>
            </div>
          </a>
          <div id="collapseTwo1" class="panel-collapse collapse">
            <div class="panel-body">

              <div class="well well-lg">
                <div class="row">
                  <div class="col-sm-12">
                    <h4>Fuel & Exhaust Information</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="numFuelTanks">Fuel Type</label></div>
                  <div class="col-sm-6">##FORMFIELD_numFuelTanks##</div>
                </div>
                <div class="row">
                  <div class="col-sm-12"><label for="fuelTankLocation">Fuel Tank Location</label></div>
                </div>
                <div class="row">
                  <div class="col-sm-4"><label>##FORMFIELD_fuelTankLocationL##</label></div>
                  <div class="col-sm-4"><label>##FORMFIELD_fuelTankLocationR##</label></div>
                  <div class="col-sm-4"><label>##FORMFIELD_fuelTankLocationCtr##</label></div>
                </div>

                <div class="row">
                  <div class="col-sm-6"><label for="fuelType">Fuel Type</label></div>
                  <div class="col-sm-6">##FORMFIELD_fuelType##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="exhaustType">Exhaust Type</label></div>
                  <div class="col-sm-6">##FORMFIELD_exhaustType##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="exhaustLoc">Exhaust Location</label></div>
                  <div class="col-sm-6">##FORMFIELD_exhaustLoc##</div>
                </div>
              </div>

              <div class="well well-lg">
                <div class="row">
                  <div class="col-sm-12">
                    <h4>Brakes & Suspension</h4>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6"><label for="brakeType">Brake Type</label></div>
                  <div class="col-sm-6">##FORMFIELD_brakeType##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="frameType">Frame Type</label></div>
                  <div class="col-sm-6">##FORMFIELD_frameType##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="suspension_type">Suspension Type</label></div>
                  <div class="col-sm-6">##FORMFIELD_suspension_type##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="dump_switch">Suspension Dump Switch</label></div>
                  <div class="col-sm-6">##FORMFIELD_dump_switch##</div>
                </div>
              </div>

              <div class="well well-lg">
                <div class="row">
                  <div class="col-sm-12">
                    <h4>Chassis Options</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="keyCode">Key Code</label></div>
                  <div class="col-sm-6">##FORMFIELD_keyCode##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="numKeys">Number of Keys</label></div>
                  <div class="col-sm-6">##FORMFIELD_numKeys##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="numBatteries">Number of Batteries</label></div>
                  <div class="col-sm-6">##FORMFIELD_numBatteries##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="horn">Air Horn</label></div>
                  <div class="col-sm-6">##FORMFIELD_horn##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="horn">Horn Location</label></div>
                  <div class="col-sm-6">##FORMFIELD_hornLocation##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="antenna">Antenna</label></div>
                  <div class="col-sm-6">##FORMFIELD_antenna##</div>
                </div>

                <div class="row">
                  <div class="col-sm-6"><label for="front_bumper">Front Bumper</label></div>
                  <div class="col-sm-6">##FORMFIELD_front_bumper##</div>
                </div>

                <div class="row">
                  <div class="col-sm-6"><label for="glad_hands">Glad Hands</label></div>
                  <div class="col-sm-6">##FORMFIELD_glad_hands##</div>
                </div>

                <div class="row">
                  <div class="col-sm-6"><label for="trailer_socket_type">Trailer Socket</label></div>
                  <div class="col-sm-6">##FORMFIELD_trailer_socket_type##</div>
                </div>

                <div class="row">
                  <div class="col-sm-6"><label for="certIncompleteVehDoc">Incomplete Vehicle Document</label></div>
                  <div class="col-sm-6">##FORMFIELD_certIncompleteVehDoc##</div>
                </div>

                <div class="row">
                  <div class="col-sm-6"><label for="spareWheel">Spare Wheel</label></div>
                  <div class="col-sm-6">##FORMFIELD_spareWheel##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="spareTire">Spare Tire</label></div>
                  <div class="col-sm-6">##FORMFIELD_spareTire##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="spareCarrier">Spare Carrier</label></div>
                  <div class="col-sm-6">##FORMFIELD_spareCarrier##</div>
                </div>

                <div class="row">
                  <div class="col-sm-6"><label for="jack">Jack</label></div>
                  <div class="col-sm-6">##FORMFIELD_jack##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="jackTools">Jack Tools</label></div>
                  <div class="col-sm-6">##FORMFIELD_jackTools##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="lights">Lights</label></div>
                  <div class="col-sm-6">##FORMFIELD_lights##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="radio">Radio (AM/FM/CB)</label></div>
                  <div class="col-sm-6">##FORMFIELD_radio##</div>
                </div>

                <div class="row">
                  <div class="col-sm-6"><label for="airConditioner">Air Conditioner</label></div>
                  <div class="col-sm-6">##FORMFIELD_airConditioner##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="floorMats">Floor Mats</label></div>
                  <div class="col-sm-6">##FORMFIELD_floorMats##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="batteryCharged">Battery Charged</label></div>
                  <div class="col-sm-6">##FORMFIELD_batteryCharged##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="radio">System Voltage</label></div>
                  <div class="col-sm-6">##FORMFIELD_system_voltage##</div>
                </div>

              </div>

              <div class="row">
                <div class="col-sm-8">&nbsp;</div>
                <div class="col-sm-4">
                  <a href="javascript:submitCheckin('save');" class="btn" id="btn">Save</a>
                </div>
              </div>

            </div>
          </div>
        </div> <!-- Fuel/Exhaust Group -->

        <div class="panel panel-default">
          <a data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
            <div id="custom-heading-color" class="panel-heading">
              <h4 class="panel-title">Chassis Weights</h4>
            </div>
          </a>
          <div id="collapseThree1" class="panel-collapse collapse">
            <div class="panel-body">

              <div class="well well-lg">
                <div class="row">
                  <div class="col-sm-6"><label for="bare_chassis_weight">Chassis Weight (req.)</label></div>
                  <div class="col-sm-6">
                    <?php echo field_set( 'bare_chassis_weight', $spec, $globalVars['bare_chassis_weight'] ); ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="chassisFrontAxleActual">Front Axle (act.)</label></div>
                  <div class="col-sm-6">##FORMFIELD_chassisFrontAxleActual## </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="chassisRearAxleActual">Rear Axle(s) (Act.)</label></div>
                  <div class="col-sm-6">##FORMFIELD_chassisRearAxleActual##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="chassisRearRearAxleActual">Rear Rear Axle(s) (Act.)</label></div>
                  <div class="col-sm-6">##FORMFIELD_chassisRearRearAxleActual##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="bareChasWtActual">Bare Chassis Weight (act.)</label></div>
                  <div class="col-sm-6">##FORMFIELD_bareChasWtActual##</div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-8">&nbsp;</div>
                <div class="col-sm-4">
                  <a href="javascript:submitCheckin('save');" class="btn" id="btn">Save</a>
                </div>
              </div>

            </div>
          </div>
        </div> <!-- Chassis Weights Group -->

        <div class="panel panel-default">
          <a data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1">
            <div id="custom-heading-color" class="panel-heading">
              <h4 class="panel-title">Axle Information</h4>
            </div>
          </a>
          <div id="collapseFour1" class="panel-collapse collapse">
            <div class="panel-body">

              <div class="well well-lg">

                <div class="row">
                  <div class="col-sm-6"><label for="gvwr">GVWR (req.)</label></div>
                  <div class="col-sm-6">
                    <?php echo field_set( 'gvwr', $spec, $globalVars['gvwr'] ); ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="GVWRActual">GVWR (act.)</label></div>
                  <div class="col-sm-6">##FORMFIELD_GVWRActual##</div>
                </div>
                <div class="row">
                  <div class="col-sm-12">&nbsp;</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="front_gvwr">Front GAWR (req.)</label></div>
                  <div class="col-sm-6">
                    <?php echo field_set( 'front_gvwr', $spec, $globalVars['front_gvwr'] ); ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="frontAxleActual">Front Axle (act.)</label></div>
                  <div class="col-sm-6">##FORMFIELD_frontAxleActual##</div>
                </div>
                <div class="row">
                  <div class="col-sm-12">&nbsp;</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="rear_gvwr">Rear GAWR (req.)</label></div>
                  <div class="col-sm-6">
                    <?php echo field_set( 'rear_gvwr', $spec, $globalVars['rear_gvwr'] ); ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="rearAxleActual">Rear Axle (act.)</label></div>
                  <div class="col-sm-6">##FORMFIELD_rearAxleActual##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="rearAxleActual">Tandem Axle Cap. (req.)</label></div>
                  <div class="col-sm-6">
                    <?php echo field_set( 'tandem_axle_weight', $spec, $globalVars['rearAxleActual'] ); ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="tandemAxleActual">Tandem Axle (act.)</label></div>
                  <div class="col-sm-6">##FORMFIELD_tandemAxleActual##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="ca">CA (Required)</label></div>
                  <div class="col-sm-6">
                    <?php echo field_set( 'ca', $spec, $globalVars['ca'] ); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-8">&nbsp;</div>
                <div class="col-sm-4">
                  <a href="javascript:submitCheckin('save');" class="btn" id="btn">Save</a>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- Axle Info Group -->

        <div class="panel panel-default">
          <a data-toggle="collapse" data-parent="#accordion1" href="#collapseFive1">
            <div id="custom-heading-color" class="panel-heading">
              <h4 class="panel-title">Tires & Wheels</h4>
            </div>
          </a>
          <div id="collapseFive1" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="well well-lg">
                <div class="row">
                  <div class="col-sm-12">
                    <h4>Front</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="numFrontTires">Qty</label></div>
                  <div class="col-sm-6">##FORMFIELD_numFrontTires##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="frontTireSize">Size</label></div>
                  <div class="col-sm-6">##FORMFIELD_frontTireSize##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="frontTireBrand">Brand</label></div>
                  <div class="col-sm-6">##FORMFIELD_frontTireBrand##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="frontTirePressure">PSI</label></div>
                  <div class="col-sm-6">##FORMFIELD_frontTirePressure##</div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <h4>Rear</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="numRearTires">Qty</label></div>
                  <div class="col-sm-6">##FORMFIELD_numRearTires##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="rearTireSize">Size</label></div>
                  <div class="col-sm-6">##FORMFIELD_rearTireSize##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="rearTireBrand">Brand</label></div>
                  <div class="col-sm-6">##FORMFIELD_frontTireBrand##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="rearTirePressure">PSI</label></div>
                  <div class="col-sm-6">##FORMFIELD_rearTirePressure##</div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <h4>Tandem</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="numTandemTires">Qty</label></div>
                  <div class="col-sm-6">##FORMFIELD_numTandemTires##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="tandemTireSize">Size</label></div>
                  <div class="col-sm-6">##FORMFIELD_tandemTireSize##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="tandemTireBrand">Brand</label></div>
                  <div class="col-sm-6">##FORMFIELD_tandemTireBrand##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="tandemTirePressure">PSI</label></div>
                  <div class="col-sm-6">##FORMFIELD_tandemTirePressure##</div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <h4>Spare</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="numSpareTires">Qty</label></div>
                  <div class="col-sm-6">##FORMFIELD_numSpareTires##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="spareTireSize">Size</label></div>
                  <div class="col-sm-6">##FORMFIELD_spareTireSize##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="spareTireBrand">Brand</label></div>
                  <div class="col-sm-6">##FORMFIELD_spareTireBrand##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="spareTirePressure">PSI</label></div>
                  <div class="col-sm-6">##FORMFIELD_spareTirePressure##</div>
                </div>

              </div>
              <div class="row">
                <div class="col-sm-8">&nbsp;</div>
                <div class="col-sm-4">
                  <a href="javascript:submitCheckin('save');" class="btn" id="btn">Save</a>
                </div>
              </div>

            </div>
          </div>
        </div> <!-- Tires and Wheels Group -->

        <div class="panel panel-default">
          <a data-toggle="collapse" data-parent="#accordion1" href="#collapseSix1">
            <div id="custom-heading-color" class="panel-heading">
              <h4 class="panel-title">Chassis Notes</h4>
            </div>
          </a>
          <div id="collapseSix1" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="well well-lg">

                <div class="row">
                  <div class="col-sm-6"><label for="glassCondition">Glass Condition</label></div>
                  <div class="col-sm-6">##FORMFIELD_glassCondition##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="antiFreezeRating">Antifreeze Rating</label></div>
                  <div class="col-sm-6">##FORMFIELD_antiFreezeRating##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="oilGaugePSI">Oil Gauge</label></div>
                  <div class="col-sm-6">##FORMFIELD_oilGaugePSI##</div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><label for="lights">Lights Work</label></div>
                  <div class="col-sm-6">##FORMFIELD_lights##</div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="chassisCondition">Chassis Condition:</label>
                      ##FORMFIELD_chassisCondition##
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="damagesOrComments">Damage or Comments:</label>
                      ##FORMFIELD_damagesOrComments##
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="obstructionsDesc">Obstructions:</label>
                      ##FORMFIELD_obstructionsDesc##
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-8">&nbsp;</div>
                <div class="col-sm-4">
                  <a href="javascript:submitCheckin('save');" class="btn" id="btn">Save</a>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- Chassis Notes Group -->



        <div class="panel panel-default">
          <a data-toggle="collapse" data-parent="#accordion1" href="#collapseSeven1">
            <div id="custom-heading-color" class="panel-heading">
              <h4 class="panel-title">Chassis Measurements</h4>
            </div>
          </a>
          <div id="collapseSeven1" class="panel-collapse collapse">
            <div class="panel-body">

              <div class="well well-lg">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasA">A=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasA##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasB">B=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasB##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasC">C=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasC##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasD">D=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasD##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasE">E=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasE##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasF">F=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasF##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasG">G=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasG##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasH">H=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasH##</div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasI">I=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasI##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasJ">J=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasJ##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasK">K=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasK##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasL">L=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasL##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasM">M=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasM##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasN">N=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasN##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasO">O=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasO##</div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"><label for="chassisMeasP">P=</label></div>
                      <div class="col-sm-10">##FORMFIELD_chassisMeasP##</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-8">&nbsp;</div>
                <div class="col-sm-4">
                  <a href="javascript:submitCheckin('save');" class="btn" id="btn">Save</a>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- Chassis Measurements Group -->

      </div> <!-- Left Column -->

      <div class="col-sm-6" id="right-column">
        <span id="hidden_stuff">
          <div class="row">
            <div class="col-sm-12">
              <h3>Customer Information</h3>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-2"><label for="customer_name">Customer</label></div>
            <div class="col-sm-10">##FORMFIELD_customer_name##</div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-4"><label for="dk_number">DK</label></div>
                <div class="col-sm-8">##FORMFIELD_dk_number##</div>
              </div>
              <div class="row">
                <div class="col-sm-4"><label for="in_number">IN</label></div>
                <div class="col-sm-8">##FORMFIELD_in_number##</div>
              </div>
              <div class="row">
                <div class="col-sm-4"><label for="part_number">Part #</label></div>
                <div class="col-sm-8">
                  <?php
                        if($spec)
                           print $globalVars["part_number"];
                           else echo '##FORMFIELD_part_number##'; 
                     ?>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4"><label for="unitModel">Unit Model</label></div>
                <div class="col-sm-8">##FORMFIELD_unitModel##</div>
              </div>


            </div>
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-4"><label for="workOrderNumber">WO</label></div>
                <div class="col-sm-8">##FORMFIELD_workOrderNumber##</div>
              </div>

              <div class="row">
                <div class="col-sm-4"><label for="tu_po_number">PO</label></div>
                <div class="col-sm-8">##FORMFIELD_tu_po_number##</div>
              </div>

              <div class="row">
                <div class="col-sm-4"><label for="spec_number">Spec #</label></div>
                <div class="col-sm-8">##FORMFIELD_spec_number##</div>
              </div>

              <div class="row">
                <div class="col-sm-4"><label for="Orig. Mfg. Date">Checkin Date</label></div>
                <div class="col-sm-8">##FORMFIELD_checkin_date##</div>
              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <h3>Chassis Information</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2"><label for="vin">VIN #</label></div>
            <div class="col-sm-10">##FORMFIELD_vin##</div>
          </div>
          <div class="row">
            <div class="col-sm-2"><label for="chassis_dealer">Dealer</label></div>
            <div class="col-sm-10">##FORMFIELD_chassis_dealer##</div>
          </div>

          <div class="row">
            <div class="col-sm-4"><label for="orig_mfg_date">Mfg. Date</label></div>
            <div class="col-sm-8" nowrap>##FORMFIELD_orig_mfg_date##</div>
          </div>

          <div class="row">
            <div class="col-sm-4"><label for="checkInBy">Check in by</label></div>
            <div class="col-sm-8">##FORMFIELD_checkInBy##</div>
          </div>

          <div class="row">
            <div class="col-sm-12">&nbsp;</div>
          </div>
        </span>

        <div id="canvas_container" class="row">
          <div class="col-sm-12">
            <canvas id="chassis_canvas" width="490" height="280">
              Sorry, your browser doesn't support the &lt;canvas&gt; element.
            </canvas>
          </div>
        </div>
      </div> <!-- Right Column -->
    </div>
  </div>


  <div class="row">
    <div class="col-sm-12">&nbsp;</div>
  </div>

  <input type="hidden" name="action" value="">
  ##FORMFIELD_recordID##
  <input type="hidden" name="view" value="ccindetail">

</form>

<form action="ajaxFunction.php" method="post" id="upload_form" ecntype="multipart/form-data">
  <div class="row">
    <div class="col-sm-12">
      <label for="image-upload[]">Upload Chassis Images</label>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2"><input type="file" capture="camera" accept="image/*" id="image_upload" name="image_upload[]"
        multiple /></div>
    <div class="col-sm-2"><input type="submit" id="upload_images" name="upload_images" value="Upload" /></div>
  </div>
</form>

<script src="/components/com_chassis_checkin/assets/js/jquery-1.12.0.min.js" type="text/javascript"></script>
<script src="/components/com_chassis_checkin/assets/js/checkin.js" type="text/javascript"></script>
<script src="/components/com_chassis_checkin/assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--</body>
</html>-->