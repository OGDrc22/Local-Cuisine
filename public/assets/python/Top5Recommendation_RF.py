
import mysql.connector
from mysql.connector import Error
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import mean_squared_error, r2_score
import json
import sys

def fetch_ratings():
    try:
        # Establish the database connection
        connection = mysql.connector.connect(
            host='127.0.0.1',  # Your database host
            database='recipeBook',  # Your database name
            user='root',  # Your database user
            password=''  # Your database password
        )

        if connection.is_connected():
            cursor = connection.cursor(dictionary=True)
            cursor.execute("SELECT * FROM rating")
            ratings = cursor.fetchall()

            # print("Ratings data fetched successfully:")
            return ratings

    except Error as e:
        print(f"Error: {e}")
        return []

    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()
            # print("MySQL connection is closed")

def prepare_data(ratings):
    df = pd.DataFrame(ratings)
    return df

def train_model(df):
    X = df[['user_id', 'book_id']]
    y = df['stars_rated']
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)
    model = RandomForestRegressor(n_estimators=100, random_state=42)
    model.fit(X_train, y_train)
    y_pred = model.predict(X_test)
    mse = mean_squared_error(y_test, y_pred)
    # print(f"Model Mean Squared Error: {mse}")
    r2 = r2_score(y_test, y_pred)
    # print(f"R2 Score: {r2}")
    return model

def make_recommendations(model, user_id, book_ids):
    user_book_pairs = [(user_id, book_id) for book_id in book_ids]
    df = pd.DataFrame(user_book_pairs, columns=['user_id', 'book_id'])
    # df['user_id'] = df['user_id'].astype('category').cat.codes
    # df['book_id'] = df['book_id'].astype('category').cat.codes
    predictions = model.predict(df)
    recommendations = sorted(zip(book_ids, predictions), key=lambda x: x[1], reverse=True)
    return recommendations

# if __name__ == "__main__":
ratings = fetch_ratings()
if ratings:
    df = prepare_data(ratings)
    model = train_model(df)
    user_id = 1  # Example user ID
    book_ids = df['book_id'].unique()
    recommendations = make_recommendations(model, user_id, book_ids)
    # print("Top recommendations:")
    books = []
    for book_id, score in recommendations[:5]: # Top 5 recommendations
        # print(f"Book ID: {book_id}, Predicted Rating: {score}")
        books.append({'book_id': int(book_id), 'p_rating': round(score, 1)})
    print(json.dumps(books))
    # print(books)

    # sys.stdout.write(json.dumps(books))