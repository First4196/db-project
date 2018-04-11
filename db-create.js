// Create all tables needed

const config = require('./config.js');
const mysql = require('promise-mysql');
const fs = require('fs');

/*const tables = [
"account.sql",
"course.sql",
"faculty.sql",
"building.sql",
"course_sem.sql",
"exam.sql",
"curriculum.sql",
"room.sql",
"department.sql",
"prerequisite.sql",
"exam_arrangement.sql",
"professor.sql",
"lesson_plan.sql",
"course_section.sql",
"student.sql",
"bill.sql",
"news.sql",
"request.sql",
"finishes.sql",
"enrollment.sql",
"class_arrangement.sql"];
*/
async function main() {
    console.log("Creating database ...");
    let connection = await mysql.createConnection(config.database);
    try {
        await connection.query("SET FOREIGN_KEY_CHECKS=0;");
        fs.readdirSync("db_config/tables/").forEach(async (file) => {
          console.log("Creating "+file);
          await connection.query(fs.readFileSync('db_config/tables/'+file).toString());
        });
        await connection.query("SET FOREIGN_KEY_CHECKS=1;");
    }
    catch(e) {
        console.log("ERROR");
        console.log(e);
    }
    connection.end();
    console.log("Finished");
}

main();