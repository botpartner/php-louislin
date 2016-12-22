COMPOSER_BIN = ./vendor/bin

test:
	$(COMPOSER_BIN)/phpunit ./tests

testweb:
	$(COMPOSER_BIN)/phpunit ./tests

doc:
	yes yes | $(COMPOSER_BIN)/apigen generate --source=./src --destination=./docs --title jyyan-eliza

phpcs:
	$(COMPOSER_BIN)/phpcs --standard=PSR2 src/
	$(COMPOSER_BIN)/phpcs --standard=PSR2 tests/

phpcbf:
	$(COMPOSER_BIN)/phpcbf --standard=PSR2 src/
	$(COMPOSER_BIN)/phpcbf --standard=PSR2 tests/

phpmd:
	$(COMPOSER_BIN)/phpmd ./src text cleancode,codesize,controversial,design,unusedcode,naming | grep -v 'Avoid using static access to class'

check: test phpcs phpmd

