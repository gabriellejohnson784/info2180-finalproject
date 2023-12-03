
window.onload=function(){
//Place where the information will be displayed
const result =document.querySelector("#results")

const lineBreak = document.createElement('br');
const lineBreak2 = document.createElement('br');

 //creating title and adding it to the page 
 const title= document.createElement('h1');
 title.textContent='Login';
 result.appendChild(title);
 //Creating the two input fields.
 const emailfield = document.createElement('input');
 emailfield.type= 'text';
 emailfield.placeholder= 'Email Address';
 result.appendChild(emailfield);

 result.appendChild(lineBreak2);

 const passwordfield = document.createElement('input');
 passwordfield.type='text';
 passwordfield.placeholder= 'Password'
 result.appendChild(passwordfield);
 
 result.appendChild(lineBreak);
 //Creating the login button
 const loginbutton= document.createElement('button');
 loginbutton.textContent= 'Login';
 result.appendChild(loginbutton);
 

 
}

   

