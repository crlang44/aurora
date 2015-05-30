import numpy as np
import json
import sys

def readSentimentList(file_name):
    ifile = open(file_name, 'r')
    happy_log_probs = {}
    sad_log_probs = {}
    ifile.readline() #Ignore title row
    
    for line in ifile:
        tokens = line[:-1].split(',') #Split csv line excluding the newline character
        happy_log_probs[tokens[0]] = float(tokens[1])
        sad_log_probs[tokens[0]] = float(tokens[2])

    return happy_log_probs, sad_log_probs

def readTweets(inputString):
    lines = []

    lines = inputString.split('\n')

    tweets = {}
    
    nums = []


    i = 0
    for line in lines:

        line_split = line.split(',')
        tweets[i] = line_split[0]
        nums.append(int(line_split[1]))
        #tweets[i] = line[:-1]

        i = i + 1

    #put the text from the tweet into tweets array and ignore endline character

    return tweets, nums



def classifySentiment(words, happy_log_probs, sad_log_probs):
    # Get the log-probability of each word under each sentiment
    happy_probs = [happy_log_probs[word] for word in words if word in happy_log_probs]
    sad_probs = [sad_log_probs[word] for word in words if word in sad_log_probs]

    # Sum all the log-probabilities for each sentiment to get a log-probability for the whole tweet
    tweet_happy_log_prob = np.sum(happy_probs)
    tweet_sad_log_prob = np.sum(sad_probs)

    # Calculate the probability of the tweet belonging to each sentiment
    prob_happy = np.reciprocal(np.exp(tweet_sad_log_prob - tweet_happy_log_prob) + 1)
    prob_sad = 1 - prob_happy

    return prob_happy, prob_sad

def main():
    # We load in the list of words and their log probabilities
    happy_log_probs, sad_log_probs = readSentimentList('twitter_sentiment_list.csv')
    split_tweets = []
    sumVar = 0
    weightedSum = 0
    totalFollowers = 0
    inputString = sys.argv[1]

    tweets, numFollowers = readTweets(inputString)

    numTweets = len(tweets)

    #split each tweet into individual words
    for i in range(numTweets):
        split_tweet = tweets[i][:-1].split()
        split_tweets.append(split_tweet)
        # sum the total number of followers
        totalFollowers += numFollowers[i]

    for i in range(numTweets):
        happy_prob, sad_prob = classifySentiment(split_tweets[i], happy_log_probs, sad_log_probs)
        #print 'The probability that this tweet is happy is ', happy_prob, 'and the probability that the tweet is sad is', sad_prob, '\n\n'
        sumVar += happy_prob
        weightedSum += happy_prob * numFollowers[i]

    avg = sumVar/numTweets
    weightedAvg = weightedSum/numTweets
    weightedAvg /= totalFollowers
    #print json.dumps(avg, weightedAvg)
    print [avg, weightedAvg, numTweets]

#if __name__ == '__main__':
main()