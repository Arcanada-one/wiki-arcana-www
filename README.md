# Wiki Arcana website

This repository contains the bilingual static landing site for Wiki Arcana. It uses a small PHP template/content structure and has no application authentication or knowledge content.

Run `php tests/run.php` and syntax-check every PHP file before review. Deployment is permitted only from the protected default branch through a self-hosted runner. TLS material and deployment credentials belong to the runtime secret store.

Branch protection must require review plus PHP, content-parity, link, and security checks; disable force pushes; and keep deploy credentials out of forked pull-request jobs.

MIT licensed.

