// Create all tables needed

const config = require('./config.js');
const mysql = require('promise-mysql');
const fs = require('fs');

const file_to_table = [
    ["student.csv","STUDENT"]
]

async function main() {
    console.log("Populating database ...");
    let connection = await mysql.createConnection(config.database);
    try {
        //await connection.query("SET FOREIGN_KEY_CHECKS=0;");
        for(let [file,table] of file_to_table) {
            console.log("Clearing "+table);
            await connection.query(`DELETE FROM ${table}`);
            
            console.log("Populating "+file+" into "+table);
            await connection.query(`LOAD DATA LOCAL INFILE './db_config/data/${file}' INTO TABLE ${table} FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES`);
        }
        //await connection.query("SET FOREIGN_KEY_CHECKS=1;");
    }
    catch(e) {
        console.log("ERROR");
        console.log(e);
    }
    connection.end();
    console.log("Finished");
}

main();