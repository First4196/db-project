// Create all tables needed

const config = require('./config.js');
const mysql = require('promise-mysql');
const readline = require('readline');

async function main() {
    
    let connection = await mysql.createConnection(config.database);
    try {
        console.log("Deleting database ...");
        await connection.query('DROP DATABASE ' + config.database.database);
        console.log("Creating database ...");
        await connection.query('CREATE DATABASE ' + config.database.database);
    }
    catch(e) {
        console.log("ERROR");
        console.log(e);
    }
    connection.end();
    console.log("Finished");
}

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});
rl.question('Are you sure (Y) ', async (answer) => {
    if(answer == 'Y') {
        await main();
    }
    rl.close();
});
