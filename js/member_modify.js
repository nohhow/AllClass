function check_input()
{
   if (!document.member_form.pass.value)
   {
       alert("비밀번호를 입력하세요!");    
       document.member_form.pass.focus();
       return;
   }

   if (!document.member_form.pass_confirm.value)
   {
       alert("비밀번호확인을 입력하세요!");    
       document.member_form.pass_confirm.focus();
       return;
   }

   if (!document.member_form.name.value)
   {
       alert("이름을 입력하세요!");    
       document.member_form.name.focus();
       return;
   }

   if (!document.member_form.email1.value)
   {
       alert("이메일 주소를 입력하세요!");    
       document.member_form.email1.focus();
       return;
   }

   if (!document.member_form.email2.value)
   {
       alert("이메일 주소를 입력하세요!");    
       document.member_form.email2.focus();
       return;
   }

   if (!document.member_form.sex.value) {
     alert("성별을 선택해주세요!");    
     document.member_form.sex.focus();
     return;
   }

   if (document.member_form.pass.value != 
         document.member_form.pass_confirm.value)
   {
       alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
       document.member_form.pass.focus();
       document.member_form.pass.select();
       return;
   }

   if (document.member_form.birth.value.length != 8) {
     alert("생년월일을 다시 입력해 주세요!\n예시: 1997년 9월 23일생일 경우\n 19970923");
     document.member_form.birth.focus();
     document.member_form.birth.select();
     return;
 }

   document.member_form.submit();
}

function reset_form()
{
   document.member_form.id.value = "";  
   document.member_form.pass.value = "";
   document.member_form.pass_confirm.value = "";
   document.member_form.name.value = "";
   document.member_form.email1.value = "";
   document.member_form.email2.value = "";
   document.getElementById("man").checked = false;
   document.getElementById("woman").checked = false;
   document.member_form.birth.value = "";     
   document.member_form.id.focus();

   return;
}