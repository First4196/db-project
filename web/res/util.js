function getCurrentSemester(){
  let d=new Date()
  const y = d.getFullYear()
  const m = d.getMonth()+1
  if(8<=m && m<=12)return {course_semester:1,course_year:y}
  else if(1<=m && m<=5)return {course_semester:2,course_year:y-1}
  else return {course_semester:3,course_year:y-1}
}


function makeQueryArgv(arr){
  console.log(arr)
  if(!arr)return ''
  else return arr.map(x=>'ARGV[]='+x).join('&')
}
function makeQuery(name,...arr){
  return encodeURI(['WHAT='+name,makeQueryArgv(arr)].join('&'))
}

function queryPromise(...arr) {
  return new Promise((res,rej) => {
    $.post('do.php',makeQuery(...arr),data => {
      res(data);
    }).fail(err => {
      rej(err);
    });
  });
}