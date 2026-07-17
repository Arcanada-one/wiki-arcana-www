# Wiki Arcana website

This repository contains the bilingual coming-soon landing site for Wiki Arcana. It uses PHP templates, EN/RU content files, Alpine.js 3, and a locally built Tailwind CSS v3 stylesheet. It has no application authentication or knowledge content.

Install and build the committed stylesheet before review:

```sh
npm install
npm run build:css
php tests/run.php
```

For local browser verification, run `php -S 127.0.0.1:8099 index.php`, then open `http://127.0.0.1:8099/en/` or `http://127.0.0.1:8099/ru/`. Syntax-check every PHP file before review. Deployment is permitted only from the protected default branch through the canonical reusable workflow. TLS material and deployment credentials belong to the runtime secret store.

Branch protection must require review plus PHP, content-parity, link, and security checks; disable force pushes; and keep deploy credentials out of forked pull-request jobs.

MIT licensed.
