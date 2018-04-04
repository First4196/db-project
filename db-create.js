// Create all tables needed

const config = require('./config.js');
const mysql = require('promise-mysql');
const fs = require('fs');

const tables = ["faculty.sql","account.sql","student.sql","professor.sql","course.sql","course_sem.sql","course_section.sql","building.sql","room.sql","exam.sql"];

async function main() {
    console.log("Creating database ...");
    let connection = await mysql.createConnection(config.database);
    try {
        for(let tableName of tables) {
            console.log("Running "+tableName);
            await connection.query(fs.readFileSync('db_config/tables/'+tableName).toString());
        }
    }
    catch(e) {
        console.log("ERROR");
        console.log(e);
    }
    connection.end();
    console.log("Finished");
}

main();