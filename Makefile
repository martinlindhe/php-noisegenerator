.PHONY: test

lint:
	./vendor/bin/phpcs --standard=test/phpcs-ruleset.xml src test

clean:
	rm *.png
