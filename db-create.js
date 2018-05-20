// Create all tables needed
const topo = require('./db-topo.js');
const config = require('./config.js');
const mysql = require('promise-mysql');
const fs = require('fs');

async function main() {
    console.log("Creating database ...");
    let connection = await mysql.createConnection(config.database);
    try {
        //await connection.query("SET FOREIGN_KEY_CHECKS=0;");
        for(let file of topo.getTopoOfTable()) {
            console.log("Creating "+file);
            await connection.query(fs.readFileSync(`db_config/tables/${file}.sql`).toString());
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