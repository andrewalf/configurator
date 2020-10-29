/**
 * Сначала думал для простого стаб-сервиса использовать просто ноду,
 * но потом, в процессе, конечно, пожалел, надо было экспресс подтянуть, чтоб
 * хотя бы руками body запроса не собирать и роутинг не колхозить, но что сделано,
 * то сделано :)
 */

const http = require("http");
const port = 8000;

/**
 * Для хранения опций, вместо какого-то персистентного хранилища
 */
const options = [
    {
        'name': 'rest_option_1',
        'type': 'string',
        'value': '',
    },
    {
        'name': 'rest_option_2',
        'type': 'bool',
        'value': false,
    },
    {
        'name': 'rest_option_3',
        'type': 'array',
        'value': [],
    },
];

const requestHandler = async (req, res) => {
    res.setHeader("Content-Type", "application/json");

    if (req.method === 'GET' && req.url === '/options') {
        res.writeHead(200);
        res.end(JSON.stringify(options));
        return;
    }
    
    const match = /^\/options\/(?<optionName>\w+)$/gi.exec(req.url);

    if (req.method === 'PATCH' && match !== null) {
        let value = null;

        try {
            let body = await getRequestBody(req);

            if (body) {
                value = body.value;
            }
        } catch (error) {
            sendHttpError(res, 422, "Invalid json");
            return;
        }

        if (!value) {
            sendHttpError(res, 422, "Value is empty");
            return;
        }

        try {
            editOption(match.groups.optionName, value);
        } catch (error) {
            sendHttpError(res, 422, error.message);
            return;
        }

        res.writeHead(200);
        res.end(JSON.stringify());
        return;
    }

    sendHttpError(res, 404, "Unknown endpoint");
}

const getRequestBody = async (req) => {
    return new Promise((resolve, reject) => {
        let body = '';

        req.on('data', chunk => {
            body += chunk.toString();
        });
    
        req.on('end', () => {
            resolve(JSON.parse(body));
        });

        req.on('error', (error) => {
            reject(error);
        });
      })
}

const editOption = (name, value) => {
    if (!optionIsValid(name, value)) {
        throw new Error('Invalid setting type');
    }

    for (const option of options) {
        if (option.name === name) {
            option.value = value;
            return;
        }
    }

    throw new Error("Invalid setting name");
}

const optionIsValid = (name, value) => {
    switch (name) {
        case 'rest_option_1':
            if (typeof value !== 'string') {
                return false;
            }
            break;
            
        case 'rest_option_2':
            if (typeof value !== 'boolean') {
                return false;
            }
            break;

        case 'rest_option_3':
            if (!Array.isArray(value)) {
                return false;
            }
            break;
    }

    return true;
}

const sendHttpError = (res, code, message) => {
    res.writeHead(code);

    res.end(JSON.stringify({
        "error": message,
    }));
}

const server = http.createServer(requestHandler);
server.listen(port);
console.log('Rest server is running');