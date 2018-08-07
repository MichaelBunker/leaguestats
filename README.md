# League Stats

An API to display statistics for competitive League of Legends players in the LCS. Hosted at http://proleaguestats.com.


```
// Resources available.
/teams
/players
/matches
/games
/player/game/stats
/player/game/stats/average
/player/game/stats/total
/team/game/stats
/team/game/stats
```

### Example Queries

```
// Get total stats for the player Doublelift.

http://proleaguestats.com/player/game/stats/total?player=doublelift

{
    "count": 1,
    "results": [
        {
            "player": {
                "name": "doublelift",
                "team": {
                    "organization": "Team Liquid",
                    "abbr": "TL",
                    "region": "NA"
                },
                "position": "Adc",
                "active": true
            },
            "kills": 50,
            "assists": 49,
            "deaths": 18,
            "wardsPlaced": 135,
            "damageDealt": 177864,
            "gold": 161406,
            "creepScore": 3592,
            "visionScore": 483
        }
    ],
    "success": true,
    "messages": []
}
```

Some other sample queries.
```
// Get all games under 30 minutes in length.
http://proleaguestats.com/games?duration<1200
// Get all teams except TSM.
http://proleaguestats.com/teams?abbr<>TSM
// Get teams with any of the provided names.
http://proleaguestats.com/teams?abbr=TL|abbr=TSM|abbr=C9
```

## Built With

* [Symfony](https://symfony.com/)
* [PHPUnit](https://phpunit.de/)
