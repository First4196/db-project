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
      if(data == "false") rej(data);
      else res(data);
    }).fail(err => {
      rej(err);
    });
  });
}

function groupBy(arr,key) {
  let toRet = {};
  for(let obj of arr) {
    let keyVal = obj[key];
    if(!(keyVal in toRet)) {
      toRet[keyVal] = [];
    }
    toRet[keyVal].push(obj);
  }
  return toRet;
}

function forEachIn(obj,callback) {
  for(var i in obj) {
    callback(i,obj[i]);
  }
}

function formatDate(dateNum) {
  return ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][dateNum-1]
}


function forEachGroupR(arr,keys,keyVal,callback) {
  if(keys.length === 0) {
    callback(keyVal,arr);
    return;
  }
  let group = groupBy(arr,keys[0]);
  for(let key in group) {
    forEachGroupR(group[key],keys.slice(1),keyVal.concat(key),callback);
  }
}

function forEachGroup(arr,keys,callback) {
  forEachGroupR(arr,keys,[],callback);
}

async function queryParsed(...arr) {
  return JSON.parse(await queryPromise(...arr));
}

function arrayEqual(arr1,arr2) {
  if(arr1.length != arr2.length) return false;
  for(let i = 0;i < arr1.length;i++) {
    if(arr1[i] !== arr2[i]) return false;
  }
  return true;
}

function filterDuplicate(arr,colName) {
  // return array with distinct colName
  let ans = [];
  let ansKey = [];
  arr.forEach(x => {
    let key = [];
    colName.forEach(cname => {
      key.push(x[cname]);
    });
    if(ansKey.every(ak => !arrayEqual(ak,key))) {
      ansKey.push(key);
      ans.push(x);
    }
  });
  console.log(arr,colName,ans,ansKey);
  return ans;
}
