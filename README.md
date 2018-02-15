# White Box PHP
This CTF challenge involves an open source php script which has a vulnerability.

### Setup
1. Edit the start.sh script to have the flag and correct IP:Port
2. Run the start.sh script on an accessible server
3. Publish the index.php

### Solution
The solution of this is to realize that hash_hmac expects the second argument (the string to encode) to be a string. when supplied with a non-string the function returns false. This false value is then used in the second hash as the secret to derive the hmac. Since we control the post input of hmac and we can force the "secret" of the hash function to be false, we can make the final check always return true.

hmac can be computed using `php -a` which gives an interactive shell to run `hash_hmac('sha256', 'your_string_here', false)`

An example of this is below using the host string of "test":
```
localhost:8888/?host=test&nonce[]=1&hmac=43b0cef99265f9e34c10ea9d3501926d27b39f57c6d674561d8ba236e7a819fb
```

This can be done with any host string, as long as you compute the matching hmac using a secret of false
