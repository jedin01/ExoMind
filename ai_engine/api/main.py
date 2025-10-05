import warnings
warnings.filterwarnings('ignore')

from fastapi import FastAPI, HTTPException, UploadFile, File
import joblib
import pandas as pd
import uvicorn
import io

dataset_path = '../data/row/importances_lightgbm.csv'
model_path = '../models/modelo_mlp.pkl'

df_train = pd.read_csv(dataset_path)

if 'unified_target' in df_train.columns:
    features = [col for col in df_train.columns if col != 'unified_target']
else:
    features = df_train.columns.tolist()

medianas = df_train[features].median().to_dict()

model = joblib.load(model_path)

app = FastAPI(title="API de Predição de Exoplanetas")

@app.get("/")
async def read_root():
    return {
        "message": "API de predição de exoplanetas rodando!",
        "expected_features": features,
        "docs_url": "http://127.0.0.1:8000/docs"
    }

@app.post("/predict_csv")
async def predict_csv(file: UploadFile = File(...)):
    if not file.filename.endswith('.csv'):
        raise HTTPException(status_code=400, detail="Arquivo deve ser um CSV")

    contents = await file.read()
    df_input = pd.read_csv(io.BytesIO(contents))

    expected_columns = features
    missing_cols = set(expected_columns) - set(df_input.columns)
    if missing_cols:
        raise HTTPException(status_code=400, detail=f"Features faltando no CSV: {missing_cols}. Esperado: {expected_columns}")

    df_input = df_input[expected_columns]
    df_input = df_input.fillna(medianas)

    predictions = model.predict(df_input).tolist()
    probabilities = model.predict_proba(df_input).tolist()

    class_names = model.classes_
    results = [
        {
            "row_index": idx,
            "prediction": pred,
            "probabilities": dict(zip(class_names, probs))
        }
        for idx, (pred, probs) in enumerate(zip(predictions, probabilities))
    ]

    return {
        "message": "Predições realizadas com sucesso",
        "results": results
    }

if __name__ == "__main__":
    uvicorn.run(app, host="127.0.0.1", port=8000)