install:
	composer install
brain-calc:
	composer run-script brain-calc
brain-even:
	composer run-script brain-even
brain-gcd:
	composer run-script brain-gcd
brain-prime:
	composer run-script brain-prime
brain-progression:
	composer run-script brain-progression
validate:
	composer validate
lint:
	composer run-script phpcs -- --standard=PSR12 src bin
