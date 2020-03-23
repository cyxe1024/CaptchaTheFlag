// Copyright 2017 Google LLC
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//      http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

'use strict';

// [START gae_node_request_example]
const express = require('express');

const app = express(); 

app.get('/', (req, res) => {
  res
    .status(200)
    .send('Henlo')
    .end();

});

let pool;
const createPool = async () => {
  pool = await mysql.createPool({
    user: process.env.root, // e.g. 'my-db-user'
    password: process.env.password, // e.g. 'my-db-password'
    database: process.env.CatData, // e.g. 'my-database'
    // If connecting via unix domain socket, specify the path
    socketPath: `/cloudsql/prime-mechanic-270715:us-central1:catsdatabase}`,
    // If connecting via TCP, enter the IP and port instead
    // host: 'localhost',
    // port: 3306,

    //...
  });
};
createPool();

// Start the server
const PORT = process.env.PORT || 8080;
app.listen(PORT, () => {
  console.log(`App listening on port ${PORT}`);
  console.log('Press Ctrl+C to quit.');
});
// [END gae_node_request_example]

module.exports = app;
