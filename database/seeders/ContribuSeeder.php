<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContribuSeeder extends Seeder
{
    public function run(): void
    {
        $coupleId = DB::table('couples')->insertGetId([
            'slug' => 'emma-and-liam',
            'partner_one' => 'Emma',
            'partner_two' => 'Liam',
            'wedding_date' => '2026-04-12',
            'venue' => 'Stones of the Yarra Valley',
            'location' => 'Coldstream, VIC',
            'story' => 'We met at a friend\'s barbecue in Melbourne five years ago. Liam spilled his drink on Emma\'s shoes, and she made him buy her a new pair. That shoe shopping trip turned into dinner, which turned into five years of adventures across Australia and beyond. Now we\'re ready to start the biggest adventure of all.',
            'photo' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&q=80',
            'cover_photo' => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=1200&q=80',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $gifts = [
            [
                'title' => 'Honeymoon in Bali',
                'description' => 'Help us spend two magical weeks exploring Bali — from Ubud\'s rice terraces to Seminyak\'s sunsets. Every dollar brings us closer to unforgettable memories.',
                'image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&q=80',
                'goal_amount' => 5000,
                'funded_amount' => 3240,
                'priority' => 'high',
                'sort_order' => 1,
            ],
            [
                'title' => 'KitchenAid Stand Mixer',
                'description' => 'For all the dinner parties, sourdough experiments, and birthday cakes in our future together.',
                'image' => 'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?w=600&q=80',
                'goal_amount' => 899,
                'funded_amount' => 899,
                'priority' => 'normal',
                'sort_order' => 2,
            ],
            [
                'title' => 'Outdoor Dining Set',
                'description' => 'An eight-seater table for our new backyard. Because every Sunday should end with friends, food, and fairy lights.',
                'image' => 'https://images.unsplash.com/photo-1600585152220-90363fe7e115?w=600&q=80',
                'goal_amount' => 1200,
                'funded_amount' => 680,
                'priority' => 'normal',
                'sort_order' => 3,
            ],
            [
                'title' => 'Wine Fridge',
                'description' => 'A proper home for our growing Yarra Valley collection. We\'ve been storing bottles in the garage — it\'s time for an upgrade.',
                'image' => 'https://images.unsplash.com/photo-1506377247377-2a5b3b417ebb?w=600&q=80',
                'goal_amount' => 750,
                'funded_amount' => 225,
                'priority' => 'low',
                'sort_order' => 4,
            ],
            [
                'title' => 'Professional Camera',
                'description' => 'To document our life together — travel, holidays, and eventually the little ones. Memories deserve more than phone photos.',
                'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=600&q=80',
                'goal_amount' => 2400,
                'funded_amount' => 960,
                'priority' => 'normal',
                'sort_order' => 5,
            ],
            [
                'title' => 'Dyson Vacuum & Air Purifier',
                'description' => 'Clean air, clean floors. The boring gift that we actually really want.',
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=600&q=80',
                'goal_amount' => 1100,
                'funded_amount' => 550,
                'priority' => 'normal',
                'sort_order' => 6,
            ],
            [
                'title' => 'Couples Cooking Class',
                'description' => 'A ten-week Italian cooking course at Melbourne\'s top culinary school. Pasta from scratch, here we come.',
                'image' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=600&q=80',
                'goal_amount' => 600,
                'funded_amount' => 600,
                'priority' => 'low',
                'sort_order' => 7,
            ],
            [
                'title' => 'Linen Bedding Set',
                'description' => 'Pure French linen for our new bed. Because we refuse to start married life with mismatched sheets.',
                'image' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=600&q=80',
                'goal_amount' => 480,
                'funded_amount' => 480,
                'priority' => 'normal',
                'sort_order' => 8,
            ],
        ];

        foreach ($gifts as $gift) {
            $giftId = DB::table('gifts')->insertGetId(array_merge($gift, [
                'couple_id' => $coupleId,
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            // Add some contributions for partially/fully funded gifts
            if ($gift['funded_amount'] > 0) {
                $contributors = [
                    ['Sarah & Mike', 'sarah@example.com'],
                    ['The Wilsons', 'wilson@example.com'],
                    ['Aunt Margaret', 'margaret@example.com'],
                    ['Josh & Tina', 'josh@example.com'],
                    ['Grandma Rose', 'rose@example.com'],
                    ['Uncle Dave', 'dave@example.com'],
                    ['The Hendersons', 'henderson@example.com'],
                ];

                $messages = [
                    'So happy for you both! Enjoy every moment.',
                    'Can\'t wait to celebrate with you!',
                    'Love you both to the moon and back.',
                    'Here\'s to a lifetime of happiness!',
                    'Wishing you all the best on your big day.',
                    null,
                    'Congratulations! You deserve the world.',
                ];

                $remaining = $gift['funded_amount'];
                $i = 0;
                while ($remaining > 0 && $i < count($contributors)) {
                    $amount = min($remaining, rand(50, 300));
                    DB::table('contributions')->insert([
                        'gift_id' => $giftId,
                        'contributor_name' => $contributors[$i][0],
                        'contributor_email' => $contributors[$i][1],
                        'amount' => $amount,
                        'message' => $messages[$i],
                        'created_at' => now()->subDays(rand(1, 30)),
                        'updated_at' => now(),
                    ]);
                    $remaining -= $amount;
                    $i++;
                }
            }
        }

        // Add RSVPs
        $rsvps = [
            ['Sarah Chen', 'sarah@example.com', 'attending', 2, null, 'So excited!'],
            ['Mike & Lisa Wilson', 'wilson@example.com', 'attending', 2, 'Lisa is vegetarian', 'Wouldn\'t miss it!'],
            ['Margaret Thompson', 'margaret@example.com', 'attending', 1, 'Gluten free', null],
            ['Josh Patel', 'josh@example.com', 'attending', 2, null, 'Can\'t wait to dance!'],
            ['David Morrison', 'dave@example.com', 'not_attending', 1, null, 'Sorry — overseas for work. Will celebrate when you\'re back!'],
            ['The Henderson Family', 'henderson@example.com', 'attending', 4, 'One child has a nut allergy', 'The kids are so excited!'],
            ['Rose Nguyen', 'rose@example.com', 'attending', 1, null, 'My darlings, I\'m so proud.'],
            ['Tom & Rachel Brooks', 'brooks@example.com', 'maybe', 2, null, 'Checking our flights — will confirm soon!'],
        ];

        foreach ($rsvps as [$name, $email, $attendance, $guests, $dietary, $message]) {
            DB::table('rsvps')->insert([
                'couple_id' => $coupleId,
                'name' => $name,
                'email' => $email,
                'attendance' => $attendance,
                'guests' => $guests,
                'dietary_requirements' => $dietary,
                'message' => $message,
                'created_at' => now()->subDays(rand(1, 20)),
                'updated_at' => now(),
            ]);
        }
    }
}
