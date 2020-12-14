install:
	composer install
brain-calc:
	./bin/brain-calc
brain-even:
	./bin/brain-even
brain-gcd:
	./bin/brain-gcd
brain-prime:
	./bin/brain-prime
brain-progression:
	./bin/brain-progression
validate:
	composer validate
lint:
	composer run-script phpcs -- --standard=PSR12 src bin
