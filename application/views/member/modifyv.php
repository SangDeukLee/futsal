<script>
    var value1 = '<?= $user_home[0] ?>';
    var value2 = '<?= $user_home[1] ?>';
</script>
<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-9 main-chart">
            <form name="form" action="/member/modify/" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="user_home[]" value="<?= $user_home[0]?>">
                <input type="hidden" name="user_home[]" value="<?= $user_home[1]?>">
                <h2>정보 수정</h2>
                <br>
                <table>
                    <tr>
                        <td width="150" height="50"><label class="control-label">ID</label></td>
                        <td><p><?= $member_info->user_id?></p></td>
                    </tr>
                    <tr>
                        <td height="50"><label class="control-label" for="signupPassword">Password</label></td>
                        <td><p><input id="signupPassword" name="pass" type="password" maxlength="25" value="<?=$member_info->user_pass?>" length="40"></p></td>
                    </tr>
                    <tr>
                        <td height="50"><label class="control-label" for="signupEmail">Email</label></td>
                        <td><p><input id="signupEmail" name="email" type="email" maxlength="50" value="<?=$member_info->user_email?>" ></p></td>
                    </tr>
                    <tr>
                        <td height="50"><label class="control-label">Phone</label></td>
                        <td><p><input type="tel" name="phone" maxlength="50" value="<?=$member_info->user_phone?>"></p></td>
                    </tr>
                    <tr>
                        <td height="50"><label class="control-label">Ability</label></td>
                        <td><p><input type="text" name="ability" maxlength="50" value="<?=$member_info->user_ability?>"></p></td>
                    </tr>
                    <tr>
                        <td height="50"><label class="control-label">Home Ground</label></td>
                        <td>
                            <p><select name="home[]" id="first" style="width:70px;" onchange="itemChange(this.form);" ></select>
                                <select name="home[]" id="second" style="width:70px;" ></select></p>
                        </td>
                    </tr>
                    <tr>
                        <td height="50"><label class="control-label">사진 선택</label></td>
                        <td><input name="pfimage" type="file" class="file"></td>
                    </tr>
                    <tr>
                        <td><button type="reset">cancel</button></td>
                        <td><input type="submit" name="submit_modify" value="Modify your account"></td>
                    </tr>


                </table>
            </form>
        </div>