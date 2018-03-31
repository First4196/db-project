// Create all tables needed

const config = require('./config.js');
const mysql = require('promise-mysql');
const fs = require('fs');

async function main() {
    console.log("Creating database ...");
    let connection = await mysql.createConnection(config.database);
    try {
        await connection.query(fs.readFileSync('db_config/tables/student.sql').toString());
    }
    catch(e) {
        console.log("ERROR");
        console.log(e);
    }
    connection.end();
    console.log("Finished");
}

main();