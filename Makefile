install:
	composer install
brain-calc:
	./bin/brain-calc.php
brain-even:
	./bin/brain-even.php
brain-gcd:
	./bin/brain-gcd.php
brain-prime:
	./bin/brain-prime.php
brain-progression:
	./bin/brain-progression.php
validate:
	composer validate
lint:
	composer run-script phpcs -- --standard=PSR12 src bin
