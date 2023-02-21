<?php
require_once '../../Config/db_conn.php';

?>
<link href="../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" style="background-color:#FFFFFF; border:solid 1px #005100;-moz-opacity:0.9;opacity:0.9;filter:alpha(opacity=9);">
  <tr>
    <td>
      <table width="100%" border="0" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;;-moz-opacity:0.7;opacity:0.7;filter:alpha(opacity=70);  ">
        <tr>
          <td width="94%" class="formtop">Add Patient </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" class="table">
        <tr>
          <td colspan="6" class="table_sub_modules">Biodata</td>
        </tr>
        <tr>
          <td>
            <div align="right">*Last Name </div>
          </td>
          <td><input class="form-control" name="LastName" type="text" id="LastName" onblur="name_string(getElementById('LastName'),'Invalid Last Name typed in')" /></td>
          <td>
            <div align="right">*First Name </div>
          </td>
          <td><input name="FirstName" type="text" class="form-control" id="FirstName" onblur="name_string(getElementById('FirstName'),'Invalid First Name typed in')" /></td>
          <td>
            <div align="right">Middle Name </div>
          </td>
          <td><input name="MiddleName" type="text" class="form-control" id="MiddleName" onblur="name_string(getElementById('MiddleName'),'Invalid Middle Name typed in')" /></td>
        </tr>
        <tr>
          <td>
            <div align="right">*ID Number </div>
          </td>
          <td><input name="IDNumber" type="text" class="form-control" id="IDNumber" onblur="normal_string(getElementById('IDNumber'),'Invalid ID Number typed in')" /></td>
          <td>
            <div align="right">Passport Number </div>
          </td>
          <td><input name="PassPortNumber" type="text" class="form-control" id="PassPortNumber" onblur="normal_string(getElementById('PassPortNumber'),'Invalid Passport Number typed in')" /></td>
          <td>
            <div align="right">NHIF No </div>
          </td>
          <td><input name="NHIFNo" type="text" class="form-control" id="NHIFNo" onblur="normal_string(getElementById('NHIFNo'),'Invalid NHIF Number typed in')" /></td>
        </tr>
        <tr>
          <td>
            <div align="right">*Date of Birth </div>
          </td>
          <td><input name="DateOfBirth" type="text" class="form-control" id="DateOfBirth" onfocus='scwShow(this,event);' onclick='scwShow(this,event);' readonly="true" /></td>
          <td>
            <div align="right">*Gender</div>
          </td>
          <td><select class="form-control" name="sex" class="form-control" id="sex">
              <option class="form-control" value="">--Please Select--</option>
              <option class="form-control" value="1">Male</option>
              <option class="form-control" value="2">Female</option>
            </select></td>
          <td>
            <div align="right">*Nationality</div>
          </td>
          <td><select class="form-control" name="Nationality" class="form-control" id="Nationality">
              <option class="form-control" value="">--Please Select--</option>
              <option value="afghan">Afghan</option>

              <option value="albanian">Albanian</option>
              <option value="algerian">Algerian</option>
              <option value="american">American</option>
              <option value="andorran">Andorran</option>
              <option value="angolan">Angolan</option>
              <option value="antiguans">Antiguans</option>

              <option value="argentinean">Argentinean</option>
              <option value="armenian">Armenian</option>
              <option value="australian">Australian</option>
              <option value="austrian">Austrian</option>
              <option value="azerbaijani">Azerbaijani</option>
              <option value="bahamian">Bahamian</option>

              <option value="bahraini">Bahraini</option>
              <option value="bangladeshi">Bangladeshi</option>
              <option value="barbadian">Barbadian</option>
              <option value="barbudans">Barbudans</option>
              <option value="batswana">Batswana</option>
              <option value="belarusian">Belarusian</option>

              <option value="belgian">Belgian</option>
              <option value="belizean">Belizean</option>
              <option value="beninese">Beninese</option>
              <option value="bhutanese">Bhutanese</option>
              <option value="bolivian">Bolivian</option>
              <option value="bosnian">Bosnian</option>

              <option value="brazilian">Brazilian</option>
              <option value="british">British</option>
              <option value="bruneian">Bruneian</option>
              <option value="bulgarian">Bulgarian</option>
              <option value="burkinabe">Burkinabe</option>
              <option value="burmese">Burmese</option>

              <option value="burundian">Burundian</option>
              <option value="cambodian">Cambodian</option>
              <option value="cameroonian">Cameroonian</option>
              <option value="canadian">Canadian</option>
              <option value="cape verdean">Cape Verdean</option>
              <option value="central african">Central African</option>

              <option value="chadian">Chadian</option>
              <option value="chilean">Chilean</option>
              <option value="chinese">Chinese</option>
              <option value="colombian">Colombian</option>
              <option value="comoran">Comoran</option>
              <option value="congolese">Congolese</option>

              <option value="congolese">Congolese</option>
              <option value="costa rican">Costa Rican</option>
              <option value="croatian">Croatian</option>
              <option value="cuban">Cuban</option>
              <option value="cypriot">Cypriot</option>
              <option value="czech">Czech</option>

              <option value="danish">Danish</option>
              <option value="djibouti">Djibouti</option>
              <option value="dominican">Dominican</option>
              <option value="dominican">Dominican</option>
              <option value="dutch">Dutch</option>
              <option value="dutchman">Dutchman</option>

              <option value="dutchwoman">Dutchwoman</option>
              <option value="east timorese">East Timorese</option>
              <option value="ecuadorean">Ecuadorean</option>
              <option value="egyptian">Egyptian</option>
              <option value="emirian">Emirian</option>
              <option value="equatorial guinean">Equatorial Guinean</option>

              <option value="eritrean">Eritrean</option>
              <option value="estonian">Estonian</option>
              <option value="ethiopian">Ethiopian</option>
              <option value="fijian">Fijian</option>
              <option value="filipino">Filipino</option>
              <option value="finnish">Finnish</option>

              <option value="french">French</option>
              <option value="gabonese">Gabonese</option>
              <option value="gambian">Gambian</option>
              <option value="georgian">Georgian</option>
              <option value="german">German</option>
              <option value="ghanaian">Ghanaian</option>

              <option value="greek">Greek</option>
              <option value="grenadian">Grenadian</option>
              <option value="guatemalan">Guatemalan</option>
              <option value="guinea-bissauan">Guinea-Bissauan</option>
              <option value="guinean">Guinean</option>
              <option value="guyanese">Guyanese</option>

              <option value="haitian">Haitian</option>
              <option value="herzegovinian">Herzegovinian</option>
              <option value="honduran">Honduran</option>
              <option value="hungarian">Hungarian</option>
              <option value="i-kiribati">I-Kiribati</option>
              <option value="icelander">Icelander</option>

              <option value="indian">Indian</option>
              <option value="indonesian">Indonesian</option>
              <option value="iranian">Iranian</option>
              <option value="iraqi">Iraqi</option>
              <option value="irish">Irish</option>
              <option value="irish">Irish</option>

              <option value="israeli">Israeli</option>
              <option value="italian">Italian</option>
              <option value="ivorian">Ivorian</option>
              <option value="jamaican">Jamaican</option>
              <option value="japanese">Japanese</option>
              <option value="jordanian">Jordanian</option>

              <option value="kazakhstani">Kazakhstani</option>
              <option value="kenyan">Kenyan</option>
              <option value="kittian and nevisian">Kittian and Nevisian</option>
              <option value="kuwaiti">Kuwaiti</option>
              <option value="kyrgyz">Kyrgyz</option>
              <option value="laotian">Laotian</option>

              <option value="latvian">Latvian</option>
              <option value="lebanese">Lebanese</option>
              <option value="liberian">Liberian</option>
              <option value="libyan">Libyan</option>
              <option value="liechtensteiner">Liechtensteiner</option>
              <option value="lithuanian">Lithuanian</option>

              <option value="luxembourger">Luxembourger</option>
              <option value="macedonian">Macedonian</option>
              <option value="malagasy">Malagasy</option>
              <option value="malawian">Malawian</option>
              <option value="malaysian">Malaysian</option>
              <option value="maldivan">Maldivan</option>

              <option value="malian">Malian</option>
              <option value="maltese">Maltese</option>
              <option value="marshallese">Marshallese</option>
              <option value="mauritanian">Mauritanian</option>
              <option value="mauritian">Mauritian</option>
              <option value="mexican">Mexican</option>

              <option value="micronesian">Micronesian</option>
              <option value="moldovan">Moldovan</option>
              <option value="monacan">Monacan</option>
              <option value="mongolian">Mongolian</option>
              <option value="moroccan">Moroccan</option>
              <option value="mosotho">Mosotho</option>

              <option value="motswana">Motswana</option>
              <option value="mozambican">Mozambican</option>
              <option value="namibian">Namibian</option>
              <option value="nauruan">Nauruan</option>
              <option value="nepalese">Nepalese</option>
              <option value="netherlander">Netherlander</option>

              <option value="new zealander">New Zealander</option>
              <option value="ni-vanuatu">Ni-Vanuatu</option>
              <option value="nicaraguan">Nicaraguan</option>
              <option value="nigerian">Nigerian</option>
              <option value="nigerien">Nigerien</option>
              <option value="north korean">North Korean</option>

              <option value="northern irish">Northern Irish</option>
              <option value="norwegian">Norwegian</option>
              <option value="omani">Omani</option>
              <option value="pakistani">Pakistani</option>
              <option value="palauan">Palauan</option>
              <option value="panamanian">Panamanian</option>

              <option value="papua new guinean">Papua New Guinean</option>
              <option value="paraguayan">Paraguayan</option>
              <option value="peruvian">Peruvian</option>
              <option value="polish">Polish</option>
              <option value="portuguese">Portuguese</option>
              <option value="qatari">Qatari</option>

              <option value="romanian">Romanian</option>
              <option value="russian">Russian</option>
              <option value="rwandan">Rwandan</option>
              <option value="saint lucian">Saint Lucian</option>
              <option value="salvadoran">Salvadoran</option>
              <option value="samoan">Samoan</option>

              <option value="san marinese">San Marinese</option>
              <option value="sao tomean">Sao Tomean</option>
              <option value="saudi">Saudi</option>
              <option value="scottish">Scottish</option>
              <option value="senegalese">Senegalese</option>
              <option value="serbian">Serbian</option>

              <option value="seychellois">Seychellois</option>
              <option value="sierra leonean">Sierra Leonean</option>
              <option value="singaporean">Singaporean</option>
              <option value="slovakian">Slovakian</option>
              <option value="slovenian">Slovenian</option>
              <option value="solomon islander">Solomon Islander</option>

              <option value="somali">Somali</option>

              <option value="south african">South African</option>
              <option value="south korean">South Korean</option>
              <option value="spanish">Spanish</option>
              <option value="sri lankan">Sri Lankan</option>
              <option value="sudanese">Sudanese</option>

              <option value="surinamer">Surinamer</option>
              <option value="swazi">Swazi</option>
              <option value="swedish">Swedish</option>
              <option value="swiss">Swiss</option>
              <option value="syrian">Syrian</option>
              <option value="taiwanese">Taiwanese</option>

              <option value="tajik">Tajik</option>
              <option value="tanzanian">Tanzanian</option>
              <option value="thai">Thai</option>
              <option value="togolese">Togolese</option>
              <option value="tongan">Tongan</option>
              <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>

              <option value="tunisian">Tunisian</option>
              <option value="turkish">Turkish</option>
              <option value="tuvaluan">Tuvaluan</option>
              <option value="ugandan">Ugandan</option>
              <option value="ukrainian">Ukrainian</option>
              <option value="uruguayan">Uruguayan</option>

              <option value="uzbekistani">Uzbekistani</option>
              <option value="venezuelan">Venezuelan</option>
              <option value="vietnamese">Vietnamese</option>
              <option value="welsh">Welsh</option>
              <option value="welsh">Welsh</option>
              <option value="yemenite">Yemenite</option>

              <option value="zambian">Zambian</option>
              <option value="zimbabwean">Zimbabwean</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <div align="right">*Religion</div>
          </td>
          <td>
            <select name="Religion" class="form-control" id="Religion">
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM Religions ORDER BY ReligionName DESC") or die(mysqli_error($conn));
              while ($recs = mysqli_fetch_array($sql)) {
              ?>
                <option class="form-control" value="<?php echo $recs['Id']; ?>"><?php echo $recs['ReligionName']; ?></option>
              <?php  }
              ?>
            </select>
          </td>
          <td>
            <div align="right">Passport Photo </div>
          </td>
          <td>
            <form action="UploadPatientPassport.php" method="post" enctype="multipart/form-data" target="upload" id="pass_upload">
              <iframe src="#" name="upload" width="400" height="100" id="upload" style="display:none"> </iframe>
              <input class="form-control" name="file" type="file" class="form-control" id="patient_passport" onchange="UploadedPhoto_validation(getElementById('patient_passport'))" />
            </form>
          </td>
          <td>
            <div align="right">Marital Status </div>
          </td>
          <td><select name="MaritalStatus" class="form-control" id="MaritalStatus">
              <option class="form-control" value="0">--Please select--</option>
              <option class="form-control" value="1">Single</option>
              <option class="form-control" value="2">Married</option>
              <option class="form-control" value="3">Divorced</option>
              <option class="form-control" value="4">Widowed</option>
            </select></td>
        </tr>
        <tr>
          <td>
            <div align="right">Employer's Details </div>
          </td>
          <td><textarea name="EmployerDetails" class="form-control" id="EmployerDetails" onblur="normal_string(getElementById('EmployerDetails'),'Invalid Employer details typed in')"></textarea></td>
          <td>
            <div align="right">Patient Type </div>
          </td>
          <td>
            <select name="PatientType" class="form-control" id="PatientType">
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM SetupPatientTypes ORDER BY TypeName DESC") or die(mysqli_error($conn));
              while ($recs = mysqli_fetch_array($sql)) {
              ?>
                <option class="form-control" value="<?php echo $recs['Id']; ?>"><?php echo $recs['TypeName']; ?></option>
              <?php  }
              ?>
            </select>
          </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" class="table">
        <tr>
          <td colspan="6" class="table_sub_modules">Contact Details </td>
        </tr>
        <tr>
          <td>
            <div align="right">*Physical Address </div>
          </td>
          <td><textarea name="PhyAddress" class="form-control" id="PhyAddress" onblur="normal_string(getElementById('PhyAddress'),'Invalid Physical Address typed in')"></textarea></td>
          <td>
            <div align="right">*Postal Address </div>
          </td>
          <td><textarea name="PostalAddress" class="form-control" id="PostalAddress" onblur="normal_string(getElementById('PostalAddress'),'Invalid Postal address typed in')" />
            </textarea></td>
          <td>
            <div align="right">*Mobile Number<br />
              Format(+254-720-123456) </div>
          </td>
          <td><input name="MobileNo" type="text" class="form-control" id="MobileNo" onblur="phone_string(getElementById('MobileNo'),'Invalid Mobile number typed in')" /></td>
        </tr>
        <tr>
          <td>
            <div align="right">Land line Number </div>
          </td>
          <td><input name="PhoneNo" type="text" class="form-control" id="PhoneNo" onblur="phone_string(getElementById('PhoneNo'),'Invalid Phone number typed in')" /></td>
          <td>
            <div align="right">Email<br />
            </div>
          </td>
          <td><input name="Email" type="text" class="form-control" id="Email" onblur="email_string(getElementById('Email'),'Invalid Email Address typed in')" /></td>
          <td>
            <div align="right"></div>
          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>
            <div align="right">Estate </div>
          </td>
          <td><input name="Estate" type="text" class="form-control" id="Estate" onblur="normal_string(getElementById('Estate'),'Invalid estate name typed in')" /></td>
          <td>
            <div align="right">House Number </div>
          </td>
          <td><input name="HouseNumber" type="text" class="form-control" id="HouseNumber" onblur="normal_string(getElementById('HouseNumber'),'Invalid house number typed in')" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
        </tr>

      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" class="table">
        <tr>
          <td colspan="6" class="table_sub_modules">Next of Kin details</td>
        </tr>
        <tr>
          <td width="21%">
            <div align="right">*Kin's names </div>
          </td>
          <td width="16%"><input name="NextOfKin" type="text" class="form-control" id="NextOfKin" onblur="namel_string(getElementById('NextOfKin'),'Invalid next of kin names typed in')" /></td>
          <td width="18%">
            <div align="right">*Telephone<br />
              Format(+254-720-123456) </div>
          </td>
          <td width="22%"><input name="NextOfKinPhone" type="text" class="form-control" id="NextOfKinPhone" onblur="phone_string(getElementById('NextOfKinPhone'),'Invalid next of kin Phone number typed in')" /></td>
          <td width="7%">
            <div align="right"> Email</div>
          </td>
          <td width="16%"><input name="NextOfKinEmail" type="text" class="form-control" id="NextOfKinEmail" onblur="email_string(getElementById('NextOfKinEmail'),'Invalid next of kin email typed in')" /></td>
        </tr>
        <tr>
          <td height="21">
            <div align="right"> Relationship with Kin </div>
          </td>
          <td><select name="NextOfKinRelationship" class="form-control" id="NextOfKinRelationship">
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM NextOfKinRelationships") or die(mysqli_error($conn));
              while ($recs = mysqli_fetch_array($sql)) {
              ?>
                <option class="form-control" value="<?php echo $recs['Id']; ?>"><?php echo $recs['RelationshipName']; ?></option>
              <?php  }
              ?>
            </select></td>
          <td>
            <div align="right"> *Address </div>
          </td>
          <td><textarea class="form-control" name="NextOfKinAddress" class="form-control" id="NextOfKinAddress" onblur="normal_string(getElementById('NextOfKinAddress'),'Invalid Next of kin address details typed in')"></textarea></td>
          <td>
            <div align="right"></div>
          </td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" class="table">
        <tr>
          <td colspan="6" class="table_sub_modules">Family Related Diseases </td>
        </tr>
        <tr>
          <td width="12%">
            <div align="right">Asthma</div>
          </td>
          <td width="16%"><input class="form-control" name="asthma" type="checkbox" id="asthma" value="1" /></td>
          <td width="15%">
            <div align="right">HyperTension</div>
          </td>
          <td width="7%"><input class="form-control" name="hypertension" type="checkbox" id="hypertension" value="1" /></td>
          <td width="18%">
            <div align="right">Cardiac Arrest </div>
          </td>
          <td width="32%"><input class="form-control" name="cardiacArrest" type="checkbox" id="cardiacArrest" value="1" /></td>
        </tr>
        <tr>
          <td>
            <div align="right">Diabetes</div>
          </td>
          <td><input class="form-control" name="diabetes" type="checkbox" id="diabetes" value="1" /></td>
          <td>
            <div align="right">Breast Cancer </div>
          </td>
          <td><input class="form-control" name="BreastCancer" type="checkbox" id="BreastCancer" value="1" /></td>
          <td>
            <div align="right">Others</div>
          </td>
          <td><textarea class="form-control" name="OtherChronic" class="form-control" id="OtherChronic"></textarea></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td><input class="btn btn-success" type="button" name="Button" value="Save" style="float:right;" onClick="SavePatient('add')"></td>
  </tr>
  <tr>
    <td>*-Required field </td>
  </tr>
</table>