/*require('colors');
const request = require('request');

let cheerio = require('cheerio');
let jsonframe = require('jsonframe-cheerio');

let $ = cheerio.load('https://www.tokopedia.com/sparda-store/acer-nitro-5-an515-52-51t2-i5-8300h-8gb-1tb-gtx1050-4gb-w10');
jsonframe($); // initializes the plugin

var frame = {
	"companies": {           // setting the parent item as "companies"
		"selector": "rvm-price-holder",    // defines the elements to search for
		"data": [{              // "data": [{}] defines a list of items
			"price": ".rvm-price [itemprop=price]",         // inline selector defining "name" so "company"."name"
		}]
	}

};

var companiesList = $('.rvm-pdp-product').scrape(frame);
console.log(companiesList); // Output the data in the terminal*/

let axios = require('axios');
let cheerio = require('cheerio');
//let fs = require('file-system');

axios.get('https://www.tokopedia.com/sparda-store/acer-nitro-5-an515-52-51t2-i5-8300h-8gb-1tb-gtx1050-4gb-w10')
    .then((response) => {
        if(response.status === 200) {
        const html = response.data;
        const cheerioJquery = cheerio.load(html);
        let devtoList = [];
        cheerioJquery('.rvm-price').each(function(i, elem) {
            devtoList[i] = {
                url: cheerioJquery(this).children('[itemprop="price"]').attr('content')
            }      
        });
        window.console.log(devtoList);
    }
    }, (error) => console.log(err) );