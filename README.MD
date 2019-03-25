# Medisoft Test - March 2019

This document is a quick overview of the project. Here I'll describe what tools
I've used to build and why I chose them. Then I'll show how to use it.

## The Project

This project intention is to showcase a bit of my talents building a modern
PHP web application. The focus here is the software architecture.

Some aspects of the project will be poorly handled intentionaly such as the
views. They're here just to make the whole thing work.

## Tools

As programmers we strive for complete solutions, taking as little customization
as possible to achieve our desired functionality.

Keeping this in mind and with my recent studies on Docker Compose, I decided
looking for a template project with a framework I still didn't have a chance
to work on: Symfony 4.

I've used a lot of Sensio Labs products in the past such as Symfony 2 and
Silex, and I was looking forward to Symfony 4. Here's an extract from their own
website:

> "Symfony 4 represents a rethinking of its ideas and features from the ground
> up to match the industry practices"

Sounds good, right?

Once the framework was defined, I started searching for the template docker
compose project. The best one I could find was:

https://medium.com/@romaricp/the-perfect-kit-starter-for-a-symfony-4-project-with-docker-and-php-7-2-fda447b6bca1

It was as simple as `git clone`, `docker-compose build` and `docker-compose up -d`


## Usage

Run from the project root `docker-compose build`, `docker-compose up -d` and
browse to http://localhost

Use the corresponding links for the Poker Chance Calculator and Phrase Analyser
tests.

### Poker Chance Calculator Test

Once you clicked this link you'll be presented a list with 52 cards. Pick one
and you'll start drawing cards immediately. Click on the *Draw card* link to
keep going through the deck.

Once you draw the expected card, you can restart the calculator, picking a new
card from a new deck.

### Phrase Analyser Test

When you reach the Phrase Analyser page, you'll be shown a text input and a
button labeled "Go!". That's pretty much it. Enter your phrase to get all sorts
of statistics.

Remember the input may not be over 255 chars long.

## Unit Testing

The unit tests focused on the upper level classes as I was very busy this week.
On a normal situation I'd go for 80% coverage. To run them just execute the
Symfony binary from the project root: `./bin/phpunit`