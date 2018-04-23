// Create all tables needed
const config = require('./config.js');
const mysql = require('promise-mysql');
const fs = require('fs');

async function main() {
    let connection = await mysql.createConnection(Object.assign({multipleStatements:false},config.database));
    try {
        //await connection.query("SET FOREIGN_KEY_CHECKS=0;");
        for(let file of fs.readdirSync('db_config/functions')) {
            console.log("Generating "+file);
            await connection.query(fs.readFileSync(`db_config/functions/${file}`).toString());
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