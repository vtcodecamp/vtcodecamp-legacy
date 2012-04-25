<?php

namespace VtCodeCampTest;

use VtCodeCamp\Session;

class Sessions
{
    public static function all()
    {
        $vtCodeCamp2011Event = array(
            'name'  => 'Vermont Code Camp 2011',
        );
        $dotNetTrack = array(
            'name'  => '.NET',
        );
        $webTrack = array(
            'name'  => 'Web',
        );
        $dataAndMoreTrack = array(
            'name'  => 'Data & More',
        );
        $patternsAndPracticesTrack = array(
            'name'  => 'Patterns & Practices',
        );
        $roomOneSpace = array(
            'name'  => 'Room 1',
        );
        $roomTwoSpace = array(
            'name'  => 'Room 2',
        );
        $roomThreeSpace = array(
            'name'  => 'Room 3',
        );
        $roomFourSpace = array(
            'name'  => 'Room 4',
        );
        $speakerRoomSpace = array(
            'name'  => 'Speaker Room',
        );
        $firstTimePeriod = array(
            'start' => '2011-09-10 09:00:00.000 EDT',
            'end'   => '2011-09-10 10:00:00.000 EDT',
        );
        $secondTimePeriod = array(
            'start' => '2011-09-10 10:15:00.000 EDT',
            'end'   => '2011-09-10 11:15:00.000 EDT',
        );
        $thirdTimePeriod = array(
            'start' => '2011-09-10 11:30:00.000 EDT',
            'end'   => '2011-09-10 12:30:00.000 EDT',
        );
        $fourthTimePeriod = array(
            'start' => '2011-09-10 13:30:00.000 EDT',
            'end'   => '2011-09-10 14:30:00.000 EDT',
        );
        $fifthTimePeriod = array(
            'start' => '2011-09-10 14:45:00.000 EDT',
            'end'   => '2011-09-10 15:45:00.000 EDT',
        );
        $sixthTimePeriod = array(
            'start' => '2011-09-10 16:15:00.000 EDT',
            'end'   => '2011-09-10 17:15:00.000 EDT',
        );
        $daneMorgridgeSpeaker =  array(
            '_id'               => '4f8da5835eaee',
            'first_name'        => 'Dane',
            'last_name'         => 'Morgridge',
            'twitter_username'  => 'danemorgridge',
            'bio'               => array(
                'text'          => <<<'EOD'
Dane Morgridge has been a programmer for 10+ years and has worked with numerous 
technologies in this time. His current passions are Ruby on Rails & C++. In 
addition to software development, he is the host of the Community Megaphone 
Podcast, plays the drums and also enjoys dabbling in graphic design, video 
special effects and hockey. When not with his family he is usually learning some 
new technology or working on some side projects. He can be reached through 
[http://www.danemorgridge.com](http://danemorgridge.com/) or on Twitter 
@[danemorgridge](http://twitter.com/danemorgridge).
EOD
            ),
        );
        $reneChurchillSpeaker =  array(
            '_id'               => '4f8da5835ebf4',
            'first_name'        => 'Rene',
            'last_name'         => 'Churchill',
            'bio'               => array(
                'text'          => <<<'EOD'
Rene has been programming in a wide variety of languages for over 20 years, 
including using PHP as far back as v3.0 in 1998. He provides consulting services 
as Astute Computing and is a partner in a local information venture, 
[WherezIt.com](http://www.wherezit.com/)
EOD
            ),
        );
        $joshSledSpeaker =  array(
            '_id'               => '4f8da5835ed43',
            'first_name'        => 'Josh',
            'last_name'         => 'Sled',
            'twitter_username'  => 'joshsled',
            'bio'               => array(
                'text'          => <<<'EOD'
Josh is a Burlington, VT based software developer. A professional Java developer, 
Josh has a career spanning point-of-sale biometric processing systems, 
public-facing social-networking websites, Enterprise-installed monitoring tools 
and open-source solutions for accounting and Homebrewing beer. Implementation 
languages have ranged from C to Java, Python, javascript, bash and even tcl and 
elisp, when pressed.
EOD
            ),
        );
        $etienneTremblaySpeaker =  array(
            '_id'               => '4f8da5835ed80',
            'first_name'        => 'Etienne',
            'last_name'         => 'Tremblay',
            'twitter_username'  => 'tegaaa',
            'bio'               => array(
                'text'          => <<<'EOD'
Etienne Tremblay is an Associate Director in charge of the Microsoft 
technologies center at Fujitsu Canada in Montreal. He has over 20 years of 
experience in the IT industry and he specialized in Microsoft technologies in 
the last 12 years, specifically in managing the development process, he also has 
expertise in the mining and manufacturing industries. He has spoken at various 
events since 2005 and a Microsoft ALM MVP.
EOD
            ),
        );
        $mattVanHornSpeaker =  array(
            '_id'               => '4f8da5835eeb4',
            'first_name'        => 'Matt',
            'last_name'         => 'Van Horn',
            'twitter_username'  => 'phpn00b',
            'bio'               => array(
                'text'          => <<<'EOD'
Matt Van Horn is a Sr. Consultant with Capax Global. In his current role, Matt 
is responsible for working with clients to produce applications to serve our 
clients needs. Matt, a seasoned developer with proficiencies in a wide-array of 
programming languages and platforms, focuses on creating flexible and dynamic 
code tailored to the specific needs of customers. Matt is an experienced 
presenter, regularly speaking at Usergroup meetings and Code Camps.
EOD
            ),
        );
        $vincentGrondinSpeaker =  array(
            '_id'               => '4f8da5835ef55',
            'first_name'        => 'Vincent',
            'last_name'         => 'Grondin',
            'bio'               => array(
                'text'          => <<<'EOD'
Vincent Grondin has 13 years of experience in the software developement field 
and has been using .NET in enterprise projects for 8 years now. He was involved 
in many enterprise projects for large corporations like Desjardins, Domtar, 
Cascades and Alcoa but was also part of a few projects for various government 
branches. He likes to learn new technologies related to .NET, use the new tools 
that are designed for .NET and he loves to share it all with his peers. Yes, 
he’s a confessed .NET addict, he’s also a C# MVP and is currently working at 
DMR, a Fujitsu company, as a Senior Consultant.
EOD
            ),
        );
        return array(
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835efe5',
                    'title'         => 'Registration',
                    'event'         => $vtCodeCamp2011Event,
                    'time_period'   => array(
                        'start'         => '2011-09-10 08:00:00.000 EDT',
                        'end'           => '2011-09-10 08:45:00.000 EDT',
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835f076',
                    'title'         => 'Welcome',
                    'event'         => $vtCodeCamp2011Event,
                    'time_period'   => array(
                        'start'         => '2011-09-10 08:45:00.000 EDT',
                        'end'           => '2011-09-10 09:00:00.000 EDT',
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835f191',
                    'title'         => 'Cloud Architecture Patterns for Mere Mortals with Examples in Windows Azure',
                    'description'   => array(
                        'text'          => <<<'EOD'
How do you design applications for the cloud so that they will be scalable and 
reliable? In this talk, we will explain several architectural patterns which are 
popular for cloud computing: we will look at the need for the patterns 
generally, then look concretely at how you might realize them using capabilities 
of the Windows Azure Platform. CQRS, NoSQL, Sharding, and a few smaller patterns 
will be considered.

Slides: [http://www.slideshare.net/codingoutloud/vermont-code-camp-iii-cloud-architecture-patterns-for-mere-mortals-bill-wilder-10sept2011](http://www.slideshare.net/codingoutloud/vermont-code-camp-iii-cloud-architecture-patterns-for-mere-mortals-bill-wilder-10sept2011)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dotNetTrack,
                    'space'         => $roomOneSpace,
                    'time_period'   => $firstTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da5835f299',
                            'first_name'        => 'Bill',
                            'last_name'         => 'Wilder',
                            'twitter_username'  => 'codingoutloud',
                            'bio'               => array(
                                'text'          => <<<'EOD'
Bill Wilder lives in the Boston area and has more than 20 years of professional 
experience in software development, currently focused on cloud computing with 
the Windows Azure platform. He is a Windows Azure MVP, founder of the 
[Boston Azure User Group](http://www.bostonazure.org/), and an active speaker 
and [blogger](http://blog.codingoutloud.com/).
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835f32e',
                    'title'         => 'ASP.NET MVC: A Gateway to Rails?',
                    'description'   => array(
                        'text'          => <<<'EOD'
There seem to be a lot of .NET developers taking a solid look at Ruby on Rails 
recently (and some are jumping ship on .NET) and I have to wonder if the reason 
is ASP.NET MVC. There are a lot of similarities between the two and in this 
session I will give an intro to Ruby on Rails from a ASP.NET MVC developers 
prospective and how they are similar. I took my first look at Rails several 
years ago, but it was after working with ASP.NET MVC, that I really “discovered” 
what Rails had to offer. I will share my learning process from ASP.NET MVC to 
Rails and how working with Rails has helped me be a better overall developer.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $webTrack,
                    'space'         => $roomTwoSpace,
                    'time_period'   => $firstTimePeriod,
                    'speakers'      => array(
                        $daneMorgridgeSpeaker,
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835f470',
                    'title'         => 'Introduction to SQL Server Profiler',
                    'description'   => array(
                        'text'          => <<<'EOD'
Learn how to use SQL Server Profiler/Trace to troubleshoot SQL Server 
performance and errors. This session will cover how to use Profiler to capture 
SQL Server events, creating server-side traces, creating custom templates, 
saving trace data, and interpreting trace data.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dataAndMoreTrack,
                    'space'         => $roomThreeSpace,
                    'time_period'   => $firstTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da5835f516',
                            'first_name'        => 'Jack',
                            'last_name'         => 'Corbett',
                            'twitter_username'  => 'unclebiguns',
                            'bio'               => array(
                                'text'          => <<<'EOD'
[Jack Corbett](http://www.wisemanorwiseguy.com/) has worked with SQL Server for 
over 10 years in small to mid-sized businesses ranging from manufacturing to 
non-profits. Jack has been active in PASS (Professional Association of SQL 
Server) as a key member of the organizing team for the inaugural PASS SQLRally 
2011 in Orlando and involved in the program committee for the PASS Summit 2010. 
Jack is the former president of OPASS (Orlando SQL Server user group) and one of 
the organizers of SQLSaturday #21 and #49 in Orlando. Jack has spoken at several 
user groups, SQLSaturdays, and Code Camps. When Jack is not working with SQL 
Server he enjoys playing, coaching, and watching sports.
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835f56f',
                    'title'         => 'Effective Prototyping: A developer’s guide to better design through prototyping',
                    'description'   => array(
                        'text'          => <<<'EOD'
Software prototyping is an important UX design skill that many people “just do” 
but effective prototyping requires crucial knowledge and practices that aren’t 
obvious. In this talk, Everett will explain prototyping and its goals, compare 
prototyping to sketching, and explore the different types of prototyping. He 
will then characterize effective prototyping and explain why those 
characteristics are so important. Everett will review several commonly available 
prototyping tools (including SketchFlow), and evaluate their pros and cons. He 
will conclude by working through some examples so that you can see effective 
prototyping in practice.If you or your team is prototyping now or considering 
prototyping in the future, this talk is for you!

Slides: [http://www.slideshare.net/EverettMcKay/effective-prototyping-for-vermont-code-camp](http://www.slideshare.net/EverettMcKay/effective-prototyping-for-vermont-code-camp)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $patternsAndPracticesTrack,
                    'space'         => $roomFourSpace,
                    'time_period'   => $firstTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da5835f675',
                            'first_name'        => 'Everett',
                            'last_name'         => 'McKay',
                            'twitter_username'  => 'UXDesignEdge',
                            'bio'               => array(
                                'text'          => <<<'EOD'
Everett McKay is the principal of [UX Design Edge](http://www.uxdesignedge.com/), 
a user experience design training and consulting firm specializing in helping 
non-designers based in St. Albans, Vermont. UX Design Edge’s flagship course is 
UX Design Essentials Workshop, a two-day onsite course where your team members 
can improve their UX design skills “by doing” by redesigning your own app or 
site, and User Experience Design Basics, a three-hour online training course 
that covers the essential, practical skills non-designers need to get started in 
UI design. Everett is now working on UX Design for Silverlight, a public two-day 
course that gives Silverlight developers the essentials they need to know about 
UX design. Previously, Everett was a program manager at Microsoft on the Windows 
7 and Windows Vista teams, and was responsible for the Windows User Experience 
Interaction Guidelines.
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835f70b',
                    'title'         => 'What’s New in WP 7.1 Silverlight Development',
                    'description'   => array(
                        'text'          => <<<'EOD'
The new Windows Phone 7.1 platform, codenamed “Mango”, features were unveiled 
this past April, and the developer tools were released in May. With over 500 new 
features included in this release, there is a tremendous amount of new 
functionality for developers.  This presentation will review many of these new 
features and show how they can be used to build the next generation of Windows 
Phone applications.

Slides & Code: [https://skydrive.live.com/?cid=511766c2b5c5bdd3&sc=documents&uc=2&id=511766C2B5C5BDD3%21720](https://skydrive.live.com/?cid=511766c2b5c5bdd3&sc=documents&uc=2&id=511766C2B5C5BDD3%21720)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dotNetTrack,
                    'space'         => $roomOneSpace,
                    'time_period'   => $secondTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da5835f82c',
                            'first_name'        => 'John',
                            'last_name'         => 'Garland',
                            'twitter_username'  => 'DotNetGator',
                            'bio'               => array(
                                'text'          => <<<'EOD'
John is a Senior Consultant at Wintellect and has been developing software 
professionally for over 12 years, having spent most of his career working on 
high-performance video and statistical analysis tools for premier sports teams, 
with an emphasis on the NFL, the NBA, and Division 1 NCAA Football and 
Basketball. John is an active presenter in the New England .Net Development 
Community, having spoken at recent Code Camps in New Hampshire, Vermont, and 
Massachusetts. He holds Microsoft certifications in Windows and Silverlight 
Development technologies.
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835f8d2',
                    'title'         => 'HTML5 – A Practical First Look',
                    'description'   => array(
                        'text'          => <<<'EOD'
It seems that HTML5 (or at least discussion of it) is everywhere these days. 
Let’s delve into why it, and related web standards, are getting so much 
attention. We’ll look at HTML5′s new options and elements as well as other 
specifications like CSS3, ECMAScript5, SVG, and beyond. And because knowing 
what’s new is only half the battle, we’ll also discuss practical techniques for 
implementing features today while accommodating a variety of browsers and 
clients that may not fully support these new options.

Resources: 
[http://blogs.msdn.com/b/cbowen/archive/2011/07/13/list-of-html5-presentation-resources.aspx](http://blogs.msdn.com/b/cbowen/archive/2011/07/13/list-of-html5-presentation-resources.aspx)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $webTrack,
                    'space'         => $roomTwoSpace,
                    'time_period'   => $secondTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da5835fa4c',
                            'first_name'        => 'Chris',
                            'last_name'         => 'Bowen',
                            'twitter_username'  => 'ChrisBowen',
                            'bio'               => array(
                                'text'          => <<<'EOD'
[Chris Bowen](http://blogs.msdn.com/cbowen) is a Principal Developer Evangelist 
with Microsoft, specializing in web technologies and working with customers and 
companies in the northeastern US. An architect and developer with over 18 years 
in the industry, he joined Microsoft after holding senior positions at companies 
such as Monster.com, VistaPrint, Staples, and IDX Systems. He is coauthor of 
“Essential Windows Communication Foundation” and “Professional Visual Studio 
2005 Team System” and holds an M.S. in Computer Science and a B.S. in Management 
Information Systems, both from Worcester Polytechnic Institute.
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835fae1',
                    'title'         => 'Tackling Big Data with Hadoop',
                    'description'   => array(
                        'text'          => <<<'EOD'
Are you swimming in gigabytes of log files that you can’t bring yourself to 
throw away, but don’t know how to get value from them? Are there reporting 
queries you want to run, but you can’t afford to tie up your database server 
with full table scans? Learn how Facebook, Twitter, Last.fm and others handle 
their huge data volumes using the map-reduce model and the Apache Hadoop project.

Slides: [http://www.slideshare.net/poorlytrainedape/tackling-big-data-with-hadoop-9212076](http://www.slideshare.net/poorlytrainedape/tackling-big-data-with-hadoop-9212076)
Code: [https://github.com/dehowell/hadoop-crypto-demo](https://github.com/dehowell/hadoop-crypto-demo)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dataAndMoreTrack,
                    'space'         => $roomThreeSpace,
                    'time_period'   => $secondTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da5835fb71',
                            'first_name'        => 'David',
                            'last_name'         => 'Howell',
                            'twitter_username'  => 'dehowell',
                            'bio'               => array(
                                'text'          => <<<'EOD'
David Howell is a software engineer at [Dealer.com](http://www.dealer.com/). He 
has worked on software problems in data analysis for six years, first in 
experimental particle physics and more recently as a software developer at 
Wolfram Research and [wolframalpha.com](http://www.wolframalpha.com/).
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835fcb9',
                    'title'         => 'What is functional programming?',
                    'description'   => array(
                        'text'          => <<<'EOD'
The challenges of concurrent and parallel processing as well as the addition of 
functional programming features onto imperative languages have sparked an 
increased interest in functional programming. We’ll explore the foundations of 
functional programming, how it is different from imperative programming, and 
assess the claims made about it.

Papers: [http://www.whatisfp.net/](http://www.whatisfp.net/)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $patternsAndPracticesTrack,
                    'space'         => $roomFourSpace,
                    'time_period'   => $secondTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da5835fe32',
                            'first_name'        => 'Eric',
                            'last_name'         => 'Smith',
                            'twitter_username'  => 'thinkingeric',
                            'bio'               => array(
                                'text'          => <<<'EOD'
Eric Smith is Systems Architect at EatingWell Media Group. He has been 
programming for more than 30 years and managing development projects since 1995.
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835fec7',
                    'title'         => 'EFing with Code First',
                    'description'   => array(
                        'text'          => <<<'EOD'
Code First is the newest and coolest feature of Entity Framework and really 
allows users to approach development in an more Behavior Driven Development and 
Test Driven Development style than previously allowed. In this session I’ll give 
a quick intro to Code First and how you can get started using it. I’ll even show 
off a bit of BDD and TDD goodness.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dotNetTrack,
                    'space'         => $roomOneSpace,
                    'time_period'   => $thirdTimePeriod,
                    'speakers'      => array(
                        $daneMorgridgeSpeaker,
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5835ff58',
                    'title'         => 'A Holistic view of Website Performance',
                    'description'   => array(
                        'text'          => <<<'EOD'
I will be reviewing the entire process of viewing a webpage, from DNS lookup 
through HTML rendering, discussing performance improvements at each step.

Slides: [http://www.slideshare.net/rchurchill/a-holistic-view-of-website-performance](http://www.slideshare.net/rchurchill/a-holistic-view-of-website-performance)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $webTrack,
                    'space'         => $roomTwoSpace,
                    'time_period'   => $thirdTimePeriod,
                    'speakers'      => array(
                        $reneChurchillSpeaker,
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da583600a0',
                    'title'         => 'SSIS: What’s new in SQL Server Denali?',
                    'description'   => array(
                        'text'          => <<<'EOD'
This session will demonstrate SQL Server Denali’s new features such as Server 
Deployment Model, Environments, etc. All these novelties will be shown by 
migrating a 2008 SSIS solution to Denali.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dataAndMoreTrack,
                    'space'         => $roomThreeSpace,
                    'time_period'   => $thirdTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da58360217',
                            'first_name'        => 'Christian',
                            'last_name'         => 'Cote',
                            'twitter_username'  => 'Christian_SQL',
                            'bio'               => array(
                                'text'          => <<<'EOD'
[Christian Coté](http://ia-techconsulting.com/) has been in IT for almost 14 
years. He is a Microsoft Certified Technical Specialist in Business Intelligence 
(MCTS-BI) and Microsoft Most Valuable Professional (MVP). For the last 12 years, 
he has been involved as a consultant in ETL/BI projects. His ETL projects were 
done using various ETL tools as well as using plain code with various RDBMS 
(Oracle, SQL Server).
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da583602ac',
                    'title'         => 'Functional Programming on the JVM',
                    'description'   => array(
                        'text'          => <<<'EOD'
Functional programming appears to be gaining in popularity. This session will 
give a brief explanation of what functional programming is and introduce three 
functional languages built on top of the Java Virtual Machine: Groovy, Scala, 
and Clojure. The session will cover language fundamentals, a short history of 
each language, and a comparison of how a problem can be solved in java and each 
of the functional languages.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $patternsAndPracticesTrack,
                    'space'         => $roomFourSpace,
                    'time_period'   => $thirdTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da5836033c',
                            'first_name'        => 'Jonathan',
                            'last_name'         => 'Phillips',
                            'twitter_username'  => 'hobopuma',
                            'bio'               => array(
                                'text'          => <<<'EOD'
Jonathan Phillips is a Technical Director at [Dealer.com](http://www.dealer.com/). 
Jonathan has been doing User Interface development for 13 years and has worked 
at a number of startups in Colorado before moving to Vermont in 2008.
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5836045d',
                    'title'         => 'Emacs: Everyday, Everyway',
                    'description'   => array(
                        'text'          => <<<'EOD'
“Emacs: a great OS, shame it’s missing a decent editor”. :) Emacs is indeed a 
powerful platform for running a whole set applications that serve to enhance its 
(actually quite awesome!) editing capabilities into a powerful environment for 
doing nearly any task.  From quickly editing text files to intensely editing 
source code to building projects to checking email, browsing the web, IM/IRC, 
twitter,controlling multimedia, and organizing your tasks lists … emacs really 
is a “”great”" OS. Grounded in the presenter’s everyday usage, we’ll explore 
both those mentioned applications, but also talk about the powerful core editing 
capabilities that make everything come together in a highly functional 
environment. We’ll probably digress into some of the features the presenter 
doesn’t personally use, but are clearly Awesome all the same.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'space'         => $speakerRoomSpace,
                    'time_period'   => $thirdTimePeriod,
                    'speakers'      => array(
                        $joshSledSpeaker,
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da5836060f',
                    'title'         => 'Lunch',
                    'event'         => $vtCodeCamp2011Event,
                    'time_period'   => array(
                        'start'         => '2011-09-10 12:30:00.000 EDT',
                        'end'           => '2011-09-10 13:30:00.000 EDT',
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da583606a5',
                    'title'         => 'Let’s talk Virtualization',
                    'description'   => array(
                        'text'          => <<<'EOD'
You want to learn what virtualization is all about? I’ll talk about high level 
concepts, tips and tricks and best practices. You will learn all that and even 
why Azure might be an interesting choice when we talk developer virtualization. 
Concepts like Sysprep, Differencing drives, snapshot intrigue you? I’ll let you 
know all about them and more! Come join me to explore all that virtualization 
has to offer.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dotNetTrack,
                    'space'         => $roomOneSpace,
                    'time_period'   => $fourthTimePeriod,
                    'speakers'      => array(
                        $etienneTremblaySpeaker,
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da58360735',
                    'title'         => 'Web Security Issues',
                    'description'   => array(
                        'text'          => <<<'EOD'
Examples of poor programming practices and how to exploit them so you can 
understand how to prevent these attacks. The examples are in PHP, but most 
attacks are language neutral.

Slides: [http://www.slideshare.net/rchurchill/web-security-9243493](http://www.slideshare.net/rchurchill/web-security-9243493)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $webTrack,
                    'space'         => $roomTwoSpace,
                    'time_period'   => $fourthTimePeriod,
                    'speakers'      => array(
                        $reneChurchillSpeaker,
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da58360871',
                    'title'         => 'Sampling from the Cloud Computing Smorgasbord',
                    'description'   => array(
                        'text'          => <<<'EOD'
Though it’s been around for several years, “cloud computing” is rapidly evolving, 
and a crisp, universal definition continues to elude us. In this session, we’ll 
focus not on definitions but on the concrete: the services you should look for 
in a cloud provider.  Although the content will highlight the service offerings 
of Windows Azure; we’ll also include discussion of other cloud vendor offerings 
in a compare/contrast fashion.

Slides: [http://www.slideshare.net/jimoneil/sampling-from-the-cloud-smorgasbord](http://www.slideshare.net/jimoneil/sampling-from-the-cloud-smorgasbord)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dataAndMoreTrack,
                    'space'         => $roomThreeSpace,
                    'time_period'   => $fourthTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da583609f0',
                            'first_name'        => 'Jim',
                            'last_name'         => 'O’Neil',
                            'twitter_username'  => 'jimoneil',
                            'bio'               => array(
                                'text'          => <<<'EOD'
Jim is one of the Microsoft Developer Evangelists in the New England and upstate 
New York area. He’s been focused on cloud computing and Windows Azure pretty 
much since the platform was announced at the Professional Developers Conference 
in 2008.
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da58360a84',
                    'title'         => 'FOSS in the Enterprise',
                    'description'   => array(
                        'text'          => <<<'EOD'
How do you build a successful web-based startup on free and open source software? 
There are plenty of examples out there and this session will focus on how we 
have done so at [Dealer.com](http://www.dealer.com/). We will look at 
technologies covering all aspects of our production systems, from back-end 
databases to application servers, messaging, caches, search, service 
distribution, presentation tier, and monitoring. Some of the specific 
technologies that will be covered include MongoDB, RabbitMQ, Spring, EhCache, 
and Solr. We will also discuss the steps needed to identify and select an 
appropriate open source solution and how to drive adoption at your workplace.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $patternsAndPracticesTrack,
                    'space'         => $roomFourSpace,
                    'time_period'   => $fourthTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da58360b14',
                            'first_name'        => 'Kevin',
                            'last_name'         => 'Thorley',
                            'bio'               => array(
                                'text'          => <<<'EOD'
Senior software engineer working at [Dealer.com](http://www.dealer.com/) with 10 
years of experience developing enterprise applications in Java.
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da58360ba3',
                    'title'         => 'Software Consulting',
                    'description'   => array(
                        'text'          => <<<'EOD'
Are you smart, organized, creative, and can think quickly on your feet? Want to 
make more money than your boss (or his boss for that matter) doing the same job 
you already love? If so then perhaps it is time for you to consider becoming a 
consultant. I am going to break things down about what consulting is really all 
about and how to make your clients never want to build anything ever again with 
out you. We will talk negotiating pay, finding clients, working for / with 
consulting firms, getting a cut of the larger pie, making your clients dreams 
come true, and most importantly how to deal with and keep clients.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'space'         => $speakerRoomSpace,
                    'time_period'   => $fourthTimePeriod,
                    'speakers'      => array(
                        $mattVanHornSpeaker,
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da58360c32',
                    'title'         => 'Building a Real World Application with MVC 3',
                    'description'   => array(
                        'text'          => <<<'EOD'
From input validation, to routing we will build an application that will allow 
you to understand to bend MVC 3 to your needs. You’ll see how to quickly setup a 
new site, hook it up with the new Entity Framework 4.1 templates and create some 
views with the Razor view engine. We’ll cover as much as possible for the short 
time we have together and get you excited with MVC. Questions and discussions 
are encouraged but learning is guaranteed.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dotNetTrack,
                    'space'         => $roomOneSpace,
                    'time_period'   => $fifthTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da58360db6',
                            'first_name'        => 'Maxime',
                            'last_name'         => 'Rouiller',
                            'twitter_username'  => 'MaximRouiller',
                            'bio'               => array(
                                'text'          => <<<'EOD'
Maxime is a developer at [Logiweb](http://www.logiweb.ca/), company based in 
Montreal, specialized in the development of custom software using the latest 
Microsoft Technologies such as Visual Studio 2010 and .NET Framework 4.0, 
ASP.NET MVC or Web Forms and Microsoft SQL Server databases. Logiweb implements 
the expertise of a multidisciplinary team united by strong values and develops 
using the Agile philosophy. Its team of specialists performs the development of 
accessible websites, in accordance with SGQRI 008 standard, following the WCAG 
2.0 standards issued by W3C’s WAI.
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da58360e4a',
                    'title'         => 'Introduction to the Ext JS JavaScript framework “for Rich Apps in Every Browser”',
                    'description'   => array(
                        'text'          => <<<'EOD'
jQuery may be one of the most popular JavaScript frameworks on the web today, 
but it’s not the only one. Ext JS is a mature, feature rich JavaScript framework 
from [Sencha.com](http://www.sencha.com/). It includes rich User Interface 
widgets, JavaScript interactive charts (no flash needed), animations, 
drag-n-drop, eventing, a data package and more. In this session, we’ll introduce 
you to Ext JS, show some sample code, and discuss how Ext JS can be used on its 
own or alongside JQuery. We’ll also take a very brief look at SenchaTouch, an 
HTML5 mobile application framework, which makes it faster to get into the mobile 
space, than writing native apps.

Slides: [http://www.slideshare.net/joanwortman/introduction-to-the-extjs-javascript-framework-for-rich-apps-in-every-browser](http://www.slideshare.net/joanwortman/introduction-to-the-extjs-javascript-framework-for-rich-apps-in-every-browser)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $webTrack,
                    'space'         => $roomTwoSpace,
                    'time_period'   => $fifthTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da58360eda',
                            'first_name'        => 'Maura',
                            'last_name'         => 'Wilder',
                            'twitter_username'  => 'squdgy',
                            'bio'               => array(
                                'text'          => <<<'EOD'
Maura Wilder is a hands-on application architect at Teradata Corp. Besides 
toiling in Java, GWT, and ASP.Net, she spends a lot of time working on the 
“client-side”, especially with JavaScript and web application performance. She’s 
also quite adept at laundry.
EOD
                            ),
                        ),
                        array(
                            '_id'               => '4f8da58360f69',
                            'first_name'        => 'Joan',
                            'last_name'         => 'Wortman',
                            'twitter_username'  => 'zizzp',
                            'bio'               => array(
                                'text'          => <<<'EOD'
Joan Wortman is a UI architect and developer with over 15 years experience 
creating web based business applications. She is a self-professed JavaScript 
junkie and all around UI generalist.
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da58360ff8',
                    'title'         => '.NET and NoSQL: Relaxing with CouchDB',
                    'description'   => array(
                        'text'          => <<<'EOD'
NoSQL databases continue to gain popularity across a variety of development 
platforms. One of the more popular of these databases is the Apache project’s 
CouchDB. This talk introduces NoSQL concepts and .NET development with the 
document-oriented Couch database. No previous experience with NoSQL databases is 
assumed.

Slides: [http://www.codevoyeur.com/Presentations.aspx#dotnetcouch](http://www.codevoyeur.com/Presentations.aspx#dotnetcouch)
Code: [https://bitbucket.org/johnzablocki/codevoyeur-samples/src/1328aee331b5/src/PresentationSamples/NoSQLAndDotNet/CouchDBQuickStart/](https://bitbucket.org/johnzablocki/codevoyeur-samples/src/1328aee331b5/src/PresentationSamples/NoSQLAndDotNet/CouchDBQuickStart/)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dataAndMoreTrack,
                    'space'         => $roomThreeSpace,
                    'time_period'   => $fifthTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da583721e8',
                            'first_name'        => 'John',
                            'last_name'         => 'Zablocki',
                            'twitter_username'  => 'CodeVoyeur',
                            'bio'               => array(
                                'text'          => <<<'EOD'
John Zablocki is a Development Manager at HealthcareSource in Woburn, MA. He is 
the founder of Beantown ALT.NET and former adjunct at Fairfield University in 
the Dolan School of Business. John holds an M.S. in Computer Science from 
Rensselaer, where he became an enthusiast of open source technologies. Online, 
John can be found at [http://about.me/johnzablocki](http://about.me/johnzablocki). 
Offline, he can be found too infrequently with his dog, daughter, and his Fender 
Telecaster.
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da583724c0',
                    'title'         => 'Mocking and mocking frameworks',
                    'description'   => array(
                        'text'          => <<<'EOD'
Being able to understand why it’s important to unit test your application is one 
thing… Being able to acknowledge that proper unit testing inevitably comes with 
mocking is another good leap in the right direction… But the real challenge is 
to decide which mocking framework will you utilize if any and what are the 
pitfalls one must not fall into when choosing a mocking framework… Join me in an 
exploration of 3 mocking frameworks (MOQ, JustMock, Isolator) and decide for 
yourself which one you prefer. In this session we will also compare the “do it 
yourself” mocking with the power of mocking frameworks… This session requires 
working knowledge of Lambdas.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $patternsAndPracticesTrack,
                    'space'         => $roomFourSpace,
                    'time_period'   => $fifthTimePeriod,
                    'speakers'      => array(
                        $vincentGrondinSpeaker,
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da583726f6',
                    'title'         => 'Snacks',
                    'event'         => $vtCodeCamp2011Event,
                    'time_period'   => array(
                        'start'         => '2011-09-10 15:45:00.000 EDT',
                        'end'           => '2011-09-10 16:15:00.000 EDT',
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da583728c3',
                    'title'         => 'Getting High on MEF',
                    'description'   => array(
                        'text'          => <<<'EOD'
Managed Extensibility Framework (MEF) is one of the coolest things around for 
people that are writing extensible and modular applications. I will be showing 
off some of the goodies that you can do with MEF. I will be showing how to use 
it to compose both front end as well as backend systems. If you are considering 
going down the MEF path for your next or current application stop by all 
questions will be answered! Beginners welcome!
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dotNetTrack,
                    'space'         => $roomOneSpace,
                    'time_period'   => $sixthTimePeriod,
                    'speakers'      => array(
                        $mattVanHornSpeaker,
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da583729f1',
                    'title'         => 'CSS Wrangling with SASS',
                    'description'   => array(
                        'text'          => <<<'EOD'
Sass is an extension of CSS3 that adds power and elegance to the basic language. 
It allows you to use variables, nested rules, mixins, inline imports, and more, 
all with a fully CSS-compatible syntax. (With a little help from Ruby) This talk 
will cover an overview of what Sass is, how to get it, run it, and use it, and 
show some examples of its magic.

Slides: [http://www.slideshare.net/founddrama/wrangling-the-css-beast-with-sass](http://www.slideshare.net/founddrama/wrangling-the-css-beast-with-sass)
Code: [https://github.com/founddrama/vt-code-camp](https://github.com/founddrama/vt-code-camp)
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $webTrack,
                    'space'         => $roomTwoSpace,
                    'time_period'   => $sixthTimePeriod,
                    'speakers'      => array(
                        array(
                            '_id'               => '4f8da58372cb6',
                            'first_name'        => 'Rob',
                            'last_name'         => 'Friesel',
                            'twitter_username'  => 'founddrama',
                            'bio'               => array(
                                'text'          => <<<'EOD'
Rob Friesel is a Sr. User Interface Developer at [Dealer.com](http://www.dealer.com/), 
a JavaScript pedant, an occasional polyglot, and a reluctant composer of CSS; he 
blogs at [blog.founddrama.net](http://blog.founddrama.net/).
EOD
                            ),
                        ),
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da58372ece',
                    'title'         => 'VS 2010 Testing Tools',
                    'description'   => array(
                        'text'          => <<<'EOD'
Wanna get down and dirty with the new VS 2010 testing tools, TFS or branch 
strategies… Come see Vincent and Etienne at this impromptu sessions where they 
will answer questions about and demo things like Microsoft Test Manager, 
Microsoft Lab Manager, Coded UI testing, Test Impact Analysis, Branching and 
merging, and well anything you’d like to hear about ALM. Vincent is doing a talk 
on Mocking in the camp but we can continue the discussing in this sessions as 
well… Hope to see a few of you there!
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $dataAndMoreTrack,
                    'space'         => $roomThreeSpace,
                    'time_period'   => $sixthTimePeriod,
                    'speakers'      => array(
                        $vincentGrondinSpeaker,
                        $etienneTremblaySpeaker,
                    ),
                )
            ),
            Session::arrayDeserialize(
                array(
                    '_id'           => '4f8da58372fe6',
                    'title'         => 'Dependency Injection',
                    'description'   => array(
                        'text'          => <<<'EOD'
This talk will describe the what, why and how one would use Dependency Injection 
(DI) as a technique for building systems. We’ll talk about what DI (and 
Inversion of Control (IoC)) are, why it’s popular, and what the pros  and cons 
of the approach are. We’ll look at specific examples where DI helps solve 
real-world problems. Examples will be primarily in a modern high-level language 
like C#/Java, but we’ll explicitly talk about DI in the  context of multiple 
languages and systems.
EOD
                    ),
                    'event'         => $vtCodeCamp2011Event,
                    'track'         => $patternsAndPracticesTrack,
                    'space'         => $roomFourSpace,
                    'time_period'   => $sixthTimePeriod,
                    'speakers'      => array(
                        $joshSledSpeaker,
                    ),
                )
            ),
        );
    }
}
