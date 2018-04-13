const depends = {
    "account" : [],
    "bill" : ["student"],
    "building" : ["faculty"],
    "course" : [],
    "course_section" : ["course_sem"],
    "course_sem" : ["course","exam","professor"],
    "curriculum" : ["faculty"],
    "exam_arrangement" : ["exam","room"],
    "faculty" : [],
    "news" : ["course_section"],
    "professor" : ["department"],
    "room" : ["building"],
    "student" : ["curriculum","professor"],
    "request" : ["professor","student"],
    "record" : ["student","course_sem"],
    "enrollment" : ["student","course_section"],
    "class_arrangement" : ["room","course_section"],
    "exam" : [],
    "lesson_plan" : ["curriculum","course"],
    "department" : ["faculty"],
    "prerequisite" : ["course"],
    "teaching" : ["course_section","professor"]
}

function requireParent(name,alreadyProcessed) {
    if(alreadyProcessed.indexOf(name) != -1) return [];
    let toRet = alreadyProcessed;
    for(let dep of depends[name]) {
        toRet = toRet.concat(requireParent(dep,toRet).filter(x => toRet.indexOf(x)==-1));
    }
    toRet.push(name);
    
    return toRet;
}

module.exports = {
    getTopoOfTable : () => {
        let toRet = [];
        for(let name in depends) {
            toRet = toRet.concat(requireParent(name,toRet).filter(x => toRet.indexOf(x)==-1));
        }
        return toRet;
    }
}